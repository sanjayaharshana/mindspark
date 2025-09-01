/**
 * Theme Switcher for Qulint Admin Panel
 * Handles theme switching and persistence
 */

class ThemeSwitcher {
    constructor() {
        this.currentTheme = 'theme-white';
        this.themes = [
            { id: 'theme-white', name: 'Modern White', description: 'Clean white theme with blue accents' },
            { id: 'theme-light-blue', name: 'Light Blue', description: 'Soft blue theme with light backgrounds' },
            { id: 'theme-light-green', name: 'Light Green', description: 'Fresh green theme with natural colors' },
            { id: 'theme-light-purple', name: 'Light Purple', description: 'Elegant purple theme with soft tones' },
            { id: 'theme-minimal', name: 'Minimal', description: 'Minimalist black and white design' },
            { id: 'theme-modern-gray', name: 'Modern Gray', description: 'Sophisticated gray theme' },
            { id: 'theme-warm-white', name: 'Warm White', description: 'Warm white theme with orange accents' }
        ];
        
        this.init();
    }

    init() {
        this.loadSavedTheme();
        this.createThemeToggle();
        this.bindEvents();
    }

    loadSavedTheme() {
        const savedTheme = localStorage.getItem('qulint-admin-theme');
        if (savedTheme && this.themes.find(t => t.id === savedTheme)) {
            this.setTheme(savedTheme);
        } else {
            this.setTheme('theme-white');
        }
    }

    setTheme(themeId) {
        // Remove all theme classes
        document.body.classList.remove(...this.themes.map(t => t.id));
        
        // Add new theme class
        document.body.classList.add(themeId);
        
        // Update current theme
        this.currentTheme = themeId;
        
        // Save to localStorage
        localStorage.setItem('qulint-admin-theme', themeId);
        
        // Update theme toggle button
        this.updateThemeToggle();
        
        // Dispatch custom event
        document.dispatchEvent(new CustomEvent('themeChanged', { 
            detail: { theme: themeId } 
        }));
    }

    createThemeToggle() {
        // Create theme toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'theme-toggle';
        toggleBtn.innerHTML = '🎨';
        toggleBtn.title = 'Switch Theme';
        toggleBtn.id = 'theme-toggle-btn';
        
        // Create theme switcher panel
        const switcherPanel = document.createElement('div');
        switcherPanel.className = 'theme-switcher';
        switcherPanel.id = 'theme-switcher-panel';
        switcherPanel.style.display = 'none';
        
        const panelContent = `
            <h4>Choose Theme</h4>
            <div class="theme-options">
                ${this.themes.map(theme => `
                    <div class="theme-option" data-theme="${theme.id}">
                        <div class="theme-preview ${theme.id}"></div>
                        <div class="theme-info">
                            <div class="theme-name">${theme.name}</div>
                            <div class="theme-description">${theme.description}</div>
                        </div>
                    </div>
                `).join('')}
            </div>
        `;
        
        switcherPanel.innerHTML = panelContent;
        
        // Add to page
        document.body.appendChild(toggleBtn);
        document.body.appendChild(switcherPanel);
    }

    updateThemeToggle() {
        const toggleBtn = document.getElementById('theme-toggle-btn');
        if (toggleBtn) {
            // Update button color based on current theme
            const computedStyle = getComputedStyle(document.body);
            toggleBtn.style.backgroundColor = computedStyle.getPropertyValue('--primary-color');
        }
    }

    bindEvents() {
        // Theme toggle button click
        document.addEventListener('click', (e) => {
            if (e.target.id === 'theme-toggle-btn') {
                this.toggleThemePanel();
            }
        });

        // Theme option clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('.theme-option')) {
                const themeOption = e.target.closest('.theme-option');
                const themeId = themeOption.dataset.theme;
                this.setTheme(themeId);
                this.toggleThemePanel();
            }
        });

        // Close panel when clicking outside
        document.addEventListener('click', (e) => {
            const panel = document.getElementById('theme-switcher-panel');
            const toggleBtn = document.getElementById('theme-toggle-btn');
            
            if (panel && panel.style.display !== 'none' && 
                !panel.contains(e.target) && 
                !toggleBtn.contains(e.target)) {
                this.toggleThemePanel();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.toggleThemePanel();
            }
        });
    }

    toggleThemePanel() {
        const panel = document.getElementById('theme-switcher-panel');
        if (panel) {
            const isVisible = panel.style.display !== 'none';
            panel.style.display = isVisible ? 'none' : 'block';
            
            // Update active state
            const themeOptions = panel.querySelectorAll('.theme-option');
            themeOptions.forEach(option => {
                option.classList.remove('active');
                if (option.dataset.theme === this.currentTheme) {
                    option.classList.add('active');
                }
            });
        }
    }

    // Public methods
    getCurrentTheme() {
        return this.currentTheme;
    }

    getAvailableThemes() {
        return this.themes;
    }

    // Utility methods
    getThemeColors(themeId) {
        const theme = this.themes.find(t => t.id === themeId);
        if (!theme) return null;

        // Create a temporary element to get computed styles
        const temp = document.createElement('div');
        temp.className = themeId;
        document.body.appendChild(temp);
        
        const computedStyle = getComputedStyle(temp);
        const colors = {
            primary: computedStyle.getPropertyValue('--primary-color'),
            secondary: computedStyle.getPropertyValue('--secondary-color'),
            success: computedStyle.getPropertyValue('--success-color'),
            warning: computedStyle.getPropertyValue('--warning-color'),
            danger: computedStyle.getPropertyValue('--danger-color'),
            info: computedStyle.getPropertyValue('--info-color'),
            bgPrimary: computedStyle.getPropertyValue('--bg-primary'),
            bgSecondary: computedStyle.getPropertyValue('--bg-secondary'),
            textPrimary: computedStyle.getPropertyValue('--text-primary'),
            textSecondary: computedStyle.getPropertyValue('--text-secondary')
        };
        
        document.body.removeChild(temp);
        return colors;
    }

    // Animation methods
    animateThemeTransition() {
        document.body.style.transition = 'all 0.3s ease';
        setTimeout(() => {
            document.body.style.transition = '';
        }, 300);
    }

    // Export theme data
    exportThemeData() {
        return {
            currentTheme: this.currentTheme,
            availableThemes: this.themes,
            themeColors: this.getThemeColors(this.currentTheme)
        };
    }
}

// Initialize theme switcher when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.qulintThemeSwitcher = new ThemeSwitcher();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ThemeSwitcher;
}

// Global functions for easy access
window.setQulintTheme = (themeId) => {
    if (window.qulintThemeSwitcher) {
        window.qulintThemeSwitcher.setTheme(themeId);
    }
};

window.getQulintTheme = () => {
    if (window.qulintThemeSwitcher) {
        return window.qulintThemeSwitcher.getCurrentTheme();
    }
    return 'theme-white';
};

window.getQulintThemes = () => {
    if (window.qulintThemeSwitcher) {
        return window.qulintThemeSwitcher.getAvailableThemes();
    }
    return [];
};
