import csv, json

csvFilePath = "pruebas_realizadas.csv"
jsonFilePath = "pruebas_realizadas.json"

#reading csv and adding data to dictionary
data = []
with open(csvFilePath, encoding='latin-1') as csvFile:
    csvReader = csv.DictReader(csvFile)
    for csvRow in csvReader:
        data.append(csvRow)
        
#write to json file
with open('pruebas_realizadas.json', 'w') as jsonFile:
    jsonFile.write(json.dumps(data, indent=4))
