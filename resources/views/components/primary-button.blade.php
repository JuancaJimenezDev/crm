<button style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #28a745; color: white; border: none; border-radius: 4px; font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: background-color 0.15s ease-in-out;"
        onmouseover="this.style.backgroundColor='#218838'"
        onmouseout="this.style.backgroundColor='#28a745'"
        onfocus="this.style.backgroundColor='#218838'"
        onmousedown="this.style.backgroundColor='#1e7e34'">
    {{ $slot }}
</button>
