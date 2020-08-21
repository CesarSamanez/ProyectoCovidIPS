<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <div>
    <select name="region" id="regionName" onchange="loadProvincias()">
        <option value="Amazonas">Amazonas</option>
        <option value="Ancash">Ancash</option>
        <option value="Apurimac">Apurimac</option>
        <option value="Arequipa">Arequipa</option>
        <option value="Ayacucho">Ayacucho</option>
        <option value="Cajamarca">Cajamarca</option>
        <option value="Callao">Callao</option>
        <option value="Cusco">Cusco</option>
        <option value="Huancavelica">Huancavelica</option>
        <option value="Huanuco">Huanuco</option>
        <option value="Ica">Ica</option>
        <option value="Junin">Junin</option>
        <option value="La Libertad">La Libertad</option>
        <option value="Lambayeque">Lambayeque</option>
        <option value="Lima">Lima</option>
        <option value="Loreto">Loreto</option>
        <option value="Madre de Dios">Madre de Dios</option>
        <option value="Moquegua">Moquegua</option>
        <option value="Pasco">Pasco</option>
        <option value="Piura">Piura</option>
        <option value="Puno">Puno</option>
        <option value="San Martin">San Martin</option>
        <option value="Tacna">Tacna</option>
        <option value="Tumbes">Tumbes</option>
        <option value="Ucayali">Ucayali</option>
    </select>
    <div id="combProv">
        
    </div>
      <p>Total de contagiados:</p>
      <p id="total">Cargando...</p>
      <p>Total de PCR:</p>
      <p id="totalPCR">Cargando...</p>
      <p>Total de PR:</p>
      <p id="totalPR">Cargando...</p>
      <p>Total Hombres:</p>
      <p id="totalM">Cargando...</p>
      <p>Total Mujeres:</p>
      <p id="totalF">Cargando...</p>
    </div>
    <div id="distTable"></div>
  </body>
  <script src="requestProv.js"></script>
</html>
