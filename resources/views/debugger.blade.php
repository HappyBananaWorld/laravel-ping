@vite(['resources/js/app.js'])

<div id="logger-container">
    <div id="logger-header">
        💜 Laravel Ping
        <input id="search-box" type="text" placeholder="Search...">
        <button id="collapse-all">Collapse All</button>
        <button id="clear-logs">Clear Logs</button>
    </div>
    <div id="logger-messages"></div>
</div>

<style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: 'Fira Code', monospace;
        background: #1b1b2f;
        color: #eee;
    }

    #logger-container {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #logger-header {
        background: linear-gradient(90deg, #6a0dad, #9b59b6);
        padding: 1rem;
        font-size: 1.3rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    #logger-header input {
        padding: 4px 8px;
        border-radius: 4px;
        border: none;
        flex: 1;
        max-width: 200px;
    }

    #logger-header button {
        padding: 4px 8px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        background: #444;
        color: #fff;
        transition: all 0.2s ease;
    }

    #logger-header button:hover {
        background: #666;
    }

    #logger-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        background: #121026;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .message-card {
        background: #1e1b2b;
        padding: 12px 16px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        position: relative;
        opacity: 0;
        transform: translateY(-10px);
        animation: slideIn 0.3s forwards;
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-card:hover {
        transform: translateX(2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }

    .msg-info {
        font-size: 0.75rem;
        color: #aaa;
        margin-bottom: 6px;
    }

    .message-content {
        font-family: 'Fira Code', monospace;
        white-space: pre-wrap;
    }

    /* دکمه ها */
    .collapse-btn, .copy-btn {
        position: absolute;
        top: 8px;
        padding: 2px 6px;
        border: none;
        border-radius: 4px;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .collapse-btn { right: 50px; background: #444; color: #fff; }
    .copy-btn { right: 8px; background: #555; color: #fff; }

    .collapse-btn:hover { background:#666; }
    .copy-btn:hover { background:#777; }

    /* scroll */
    #logger-messages::-webkit-scrollbar {
        width: 8px;
    }
    #logger-messages::-webkit-scrollbar-track { background: #121026; }
    #logger-messages::-webkit-scrollbar-thumb { background: #555; border-radius: 4px; }
    #logger-messages::-webkit-scrollbar-thumb:hover { background: #777; }

    /* Highlighting JSON keys/values */
    .highlight-key { color: #ff79c6; }
    .highlight-string { color: #50fa7b; }
    .highlight-number { color: #bd93f9; }
    .highlight-boolean { color: #ffb86c; }
    .highlight-null { color: #f1fa8c; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const messagesContainer = document.getElementById('logger-messages');
        const searchBox = document.getElementById('search-box');
        const collapseAllBtn = document.getElementById('collapse-all');
        const clearLogsBtn = document.getElementById('clear-logs');

        const colors = ['#ff79c6','#8be9fd','#50fa7b','#f1fa8c','#bd93f9','#ffb86c'];
        const getRandomColor = () => colors[Math.floor(Math.random() * colors.length)];

        const highlightJSON = json => {
            if (typeof json !== 'object') return json;
            let str = JSON.stringify(json, null, 2)
                .replace(/"(.*?)":/g, '<span class="highlight-key">"$1"</span>:')
                .replace(/: "(.*?)"/g, ': <span class="highlight-string">"$1"</span>')
                .replace(/: (\d+)/g, ': <span class="highlight-number">$1</span>')
                .replace(/: (true|false)/g, ': <span class="highlight-boolean">$1</span>')
                .replace(/: null/g, ': <span class="highlight-null">null</span>');
            return str;
        }

        if (!window.Echo) return console.error('❌ Echo هنوز لود نشده!');

        const addMessage = (msgData) => {
            const card = document.createElement('div');
            card.classList.add('message-card');

            const info = document.createElement('div');
            info.classList.add('msg-info');
            const now = new Date();
            const time = now.toLocaleTimeString();
            const file = 'ExampleFile.php';
            const line = Math.floor(Math.random()*100)+1;
            info.textContent = `🕒 ${time} | 📄 ${file}:${line}`;
            card.appendChild(info);

            const content = document.createElement('pre');
            content.classList.add('message-content');
            content.style.color = getRandomColor();

            let isCollapsible = false;
            let originalText = '';
            if (typeof msgData === 'object') {
                isCollapsible = true;
                originalText = highlightJSON(msgData);
                content.innerHTML = originalText.slice(0,200) + (originalText.length>200?' ...':'');
            } else {
                content.textContent = msgData;
            }
            card.appendChild(content);

            // Collapse / Expand
            if (isCollapsible) {
                const btn = document.createElement('button');
                btn.classList.add('collapse-btn');
                btn.textContent = 'Show More';
                btn.addEventListener('click', () => {
                    if(btn.textContent === 'Show More') {
                        content.innerHTML = originalText;
                        btn.textContent = 'Show Less';
                    } else {
                        content.innerHTML = originalText.slice(0,200)+' ...';
                        btn.textContent = 'Show More';
                    }
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
                card.appendChild(btn);
            }

            // Copy button
            const copyBtn = document.createElement('button');
            copyBtn.classList.add('copy-btn');
            copyBtn.textContent = 'Copy';
            copyBtn.addEventListener('click', () => {
                if (isCollapsible) navigator.clipboard.writeText(JSON.stringify(msgData,null,2));
                else navigator.clipboard.writeText(msgData);
            });
            card.appendChild(copyBtn);

            messagesContainer.appendChild(card);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        window.Echo.channel('debug-triggered')
            .listen('.debug-called', e => addMessage(e.payload));

        // Search/filter
        searchBox.addEventListener('input', () => {
            const filter = searchBox.value.toLowerCase();
            Array.from(messagesContainer.getElementsByClassName('message-card'))
                .forEach(card => card.style.display = card.textContent.toLowerCase().includes(filter)?'block':'none');
        });

        // Collapse all
        collapseAllBtn.addEventListener('click', () => {
            Array.from(messagesContainer.getElementsByClassName('message-card')).forEach(card => {
                const btn = card.querySelector('.collapse-btn');
                const content = card.querySelector('.message-content');
                if(btn && content) {
                    content.innerHTML = content.innerHTML.slice(0,200)+' ...';
                    btn.textContent = 'Show More';
                }
            });
        });

        // Clear logs
        clearLogsBtn.addEventListener('click', () => messagesContainer.innerHTML = '');
    });
</script>
