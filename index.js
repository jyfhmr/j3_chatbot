// Move the mouse across the screen as a sine wave.
var robot = require("@todesktop/robotjs-prebuild");
const { exec } = require("child_process");
let asdasd="a"

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
  584123091835, 584169372345, 584245036249, 584122103424,584123091835, 584169372345, 584245036249, 584122103424,584123091835, 584169372345, 584245036249, 584122103424,584123091835, 584169372345, 584245036249, 584122103424,584123091835, 584169372345, 584245036249, 584122103424,
];

let contador = 0;

function enviarMensaje() {
  if (contador >= phones2.length) {
    console.log("Todos los mensajes enviados.");
    return;
  }

  let numero = phones2[contador];
  let mensaje = "Hola esto es una prueba jajaja"
  
  openWhatsAppApp(numero);

  delay(1500);

  robot.typeStringDelayed(mensaje,3000)

  robot.keyTap("enter");
  contador++;
  enviarMensaje();
}
enviarMensaje();
