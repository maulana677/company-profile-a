/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        "poppins": "Poppins",
      },
      colors: {
        "cp-black": "#080735",
        "cp-dark-blue": "#312ECB",
        "cp-pale-orange": "#FFEDD1",
        "cp-light-grey": "#848FA7",
        "cp-light-blue": "#007AFF",
        "cp-pale-blue": "#F2F8FF",
      }
    },
  },
  plugins: [],
}