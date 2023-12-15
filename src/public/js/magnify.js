// export function magnifyImage(e) {
//   let original = document.querySelector('#main-image'),
//     magnified = document.getElementById('large-img'),
//     style = magnified.style,
//     xAxis = e.pageX - this.offsetLeft,
//     yAxis = e.pageY - this.offsetTop,
//     imgWidth = original.width,
//     imgHeight = original.height,
//     xperc = (xAxis / imgWidth) * 100,
//     yperc = (yAxis / imgHeight) * 100;

//   // Add some margin for right edge
//   if (xAxis > 0.01 * imgWidth) {
//     xperc += 0.15 * xperc;
//   }

//   // Add some margin for bottom edge
//   if (yAxis >= 0.01 * imgHeight) {
//     yperc += 0.15 * yperc;
//   }

//   // Set the background of the magnified image horizontal
//   style.backgroundPositionX = xperc - 9 + '%';
//   // Set the background of the magnified image vertical
//   style.backgroundPositionY = yperc - 9 + '%';

//   // Move the magnifying glass with the mouse movement.
//   style.left = xAxis - 240 + 'px';
//   style.top = yAxis - 160 + 'px';
// }
