import fs from 'fs';

const svgData = fs.readFileSync('/tmp/numbered.svg', 'utf8');

const pathRegex = /<path([^>]+)>/g;
let paths = [];
let match;

while ((match = pathRegex.exec(svgData)) !== null) {
  const content = match[1];
  const idMatch = content.match(/id="([^"]+)"/);
  const dMatch = content.match(/d="([^"]+)"/);
  const styleMatch = content.match(/style="([^"]+)"/);
  
  if (dMatch && dMatch[1].length > 100) {
    paths.push({
      id: idMatch ? idMatch[1] : 'unknown',
      style: styleMatch ? styleMatch[1] : 'none',
      dLength: dMatch[1].length,
      d: dMatch[1]
    });
  }
}

paths.sort((a, b) => b.dLength - a.dLength);

fs.writeFileSync('c:\\Users\\TOUTENUN\\Desktop\\dev\\eureka\\census\\paths.json', JSON.stringify(paths.slice(0, 30), null, 2));
console.log("Extracted paths to paths.json");
