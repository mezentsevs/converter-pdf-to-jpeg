export default {
    init() {
        this.setInitialTheme();
    },

    setInitialTheme() {
        const storedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (storedTheme === 'dark' || (!storedTheme && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        }
    },

    isDark() {
        return document.documentElement.classList.contains('dark');
    },

    toggleTheme() {
        if (this.isDark()) {
            document.documentElement.classList.remove('dark');

            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');

            localStorage.setItem('theme', 'dark');
        }
    },
};
