// Move the mouse across the screen as a sine wave.
var robot = require("@todesktop/robotjs-prebuild");
const { exec } = require("child_process");
const copyPaste = require('copy-paste');

// Texto que quieres copiar al portapapeles


function delay(ms) {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < ms);
}

function openWhatsAppApp(phone) {
  const whatsappURL = `whatsapp://send?phone=${phone}`;
  const command =
    process.platform === "win32"
      ? `start ${whatsappURL}`
      : process.platform === "darwin"
      ? `open ${whatsappURL}`
      : `xdg-open ${whatsappURL}`;

  exec(command, (error, stdout, stderr) => {
    if (error) {
      console.error(`Error al intentar abrir WhatsApp: ${error.message}`);
      return;
    }
    if (stderr) {
      console.error(`Error: ${stderr}`);
      return;
    }
    console.log("WhatsApp se abrió correctamente.");
  });
}

let phones2 = [
 
];

let phones3 = [584123091835, 584122103424,584123091835, 584122103424,584123091835, 584122103424,584123091835, 584122103424,584123091835, 584122103424,584123091835, 584122103424,]

let contador = 0;

const textoACopiar = "Buenas tardes!, conseguí este contacto en Google Maps, Me presento soy José Hernández y me dedico al desarrollo de software ,Le escribo para poner a disposición mis servicios como programador, me especializo en crear tanto aplicaciones como sitios web, si necesita un programador o el desarrollo de alguna aplicación estaré encantado de trabajar en conjunto, Si quiere conocer más de mi trayectoria profesional puedo enviarle mi portafolio de proyectos";

// Copiar el texto al portapapeles
copyPaste.copy(textoACopiar, function(){console.log("Texto copiado al portapapeles:", textoACopiar);});

function enviarMensaje() {
  if (contador >= phones3.length) {
    console.log("Todos los mensajes enviados.");
    return;
  }

  let numero = phones3[contador];

  openWhatsAppApp(numero);
  delay(500);

  robot.keyTap("v", ["control"]);
  delay(500);
  robot.keyTap("enter");
  contador++;
  enviarMensaje();
}
enviarMensaje();
