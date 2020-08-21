#!/bin/bash

echo "DESCARGANDO DATA DE minsa.gob.pe...."
sudo wget https://cloud.minsa.gob.pe/s/Y8w3wHsEdYQSZRp/download
sudo mv download test.csv
sudo wget https://drive.google.com/uc?id=1DRZqKusB6GIIubx1_8T4vTqiqCCtDOlT
sudo mv 'uc?id=1DRZqKusB6GIIubx1_8T4vTqiqCCtDOlT' pruebas_realizadas.csv

echo "INICIANDO GENERACION DE ARCHIVO data.JSON...."
sudo python3 generarJSON.py
sudo python3 generarPruebasJSON.py
echo "Archivo JSON listo"

echo "CREANDO-MODIFICANDO BASE DE DATOS...."
sudo python generarBD.py
echo "Tabla registros MySQL listo"

echo "ACTUALIZANDO REGISTROS DE BASE DE DATOS..."
sudo python insertarRegistrosPruebasRealizadas.py
sudo python insertarRegistros.py
python3 generarMarcadores.py
echo "Base de datos actualizada..."

sudo rm test.csv
sudo rm data.json
