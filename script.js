const button = document.createElement('button');
button.textContent = 'Change Color';
document.body.appendChild(button);

button.addEventListener('click', () => {
  const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
  document.querySelector('h1').style.color = randomColor;
});

