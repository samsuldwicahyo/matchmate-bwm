// Konfigurasi Tailwind untuk tema romantis modern
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                romantic: {
                    DEFAULT: '#f472b6',
                    light: '#fbcfe8',
                    dark: '#be185d',
                },
            },
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
                inter: ['Inter', 'sans-serif'],
            },
            dropShadow: {
                romantic: '0 10px 25px rgba(244, 114, 182, 0.35)',
            },
        },
    },
    plugins: [],
};
