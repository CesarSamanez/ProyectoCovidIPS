import csv, json

csvFilePath = "positivosDep.csv"
jsonFilePath = "positivosDepJSON.json"

# reading csv and adding data to dictionary
data = []
with open(csvFilePath, encoding='latin-1') as csvFile:
    csvReader = csv.DictReader(csvFile)
    for csvRow in csvReader:
        data.append(csvRow)

# write to json file
with open('positivosDepJSON.json', 'w') as jsonFile:
    jsonFile.write(json.dumps(data, indent=4))
