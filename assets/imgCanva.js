// Importez votre image dans votre fichier JavaScript (ou votre template Twig) 
import monImage from '../../public/img/student-g5e8e1ed18_1920.png';

// Créez un élément image pour l'image de fond
const backgroundImage = document.createElement('img');
backgroundImage.src = monImage;

// Créez un élément canvas pour le carré coloré ondulé
const canvas = document.createElement('canvas');
canvas.width = backgroundImage.width;
canvas.height = backgroundImage.height / 4;
const ctx = canvas.getContext('2d');

// Dessinez un rectangle sur le canvas
ctx.fillStyle = 'blue';
ctx.fillRect(0, 0, canvas.width, canvas.height);

// Fonction pour dessiner une ligne ondulée pour le haut du rectangle
function drawWaveLine(context, startX, startY, endX, endY, wavelength, amplitude) {
  const step = wavelength / 4;
  context.moveTo(startX, startY);
  for (let x = startX; x < endX; x += step) {
    const y = startY + amplitude * Math.sin((x - startX) * (2 * Math.PI / wavelength));
    context.lineTo(x + step, y);
  }
  context.lineTo(endX, endY);
  context.lineTo(startX, endY);
  context.closePath();
}

// Dessinez une ligne ondulée pour le haut du rectangle
ctx.fillStyle = 'red';
drawWaveLine(ctx, 0, 0, canvas.width, 0, 50, 10);
ctx.fill();

// Convertissez le canvas en base64 pour afficher dans un élément image
const dataURL = canvas.toDataURL();
const overlayImage = document.createElement('img');
overlayImage.src = dataURL;

// Créez un conteneur pour les deux images et ajoutez-le à la page
const container = document.createElement('div');
container.style.position = 'relative';
container.appendChild(backgroundImage);
container.appendChild(overlayImage);
document.body.appendChild(container);

// Positionnez l'élément canvas sur l'image de fond
overlayImage.style.position = 'absolute';
overlayImage.style.top = 0;
overlayImage.style.left = 0;
