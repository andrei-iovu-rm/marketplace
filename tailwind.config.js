module.exports = {
  content: [
      './storage/framework/views/*.php',
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require("daisyui")
  ],
  // daisyUI config (optional)
  daisyui: {
      styled: true,
      themes: false,
      base: true,
      utils: true,
      logs: true,
      rtl: false,
  },
}
