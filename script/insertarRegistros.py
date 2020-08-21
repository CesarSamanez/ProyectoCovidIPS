import pymysql
import os
import json

# read JSON file which is in the next parent folder
file = 'data.json'
json_data = open(file).read()
json_obj = json.loads(json_data)

# do validation and checks before insert


def validate_string(val):
    if val != None:
        if type(val) is int:
            # for x in val:
            #   print(x)
            return str(val).encode('utf-8')
        else:
            return val


# connect to MySQL
con = pymysql.connect(host='localhost', user='test',
                      passwd='EkMGdb5c', db='data')
cursor = con.cursor()

cont = 1
# parse json data to SQL insert
for i, item in enumerate(json_obj):
    uuid = validate_string(item.get("UUID", None))
    departamento = validate_string(item.get("DEPARTAMENTO", None))
    provincia = validate_string(item.get("PROVINCIA", None))
    distrito = validate_string(item.get("DISTRITO", None))
    metododx = validate_string(item.get("METODODX", None))
    edad = validate_string(item.get("EDAD", None))
    sexo = validate_string(item.get("SEXO", None))
    fecha_resultado = validate_string(item.get("FECHA_RESULTADO", None))

    cursor.execute("INSERT INTO positivos (uuid, departamento, provincia, distrito, metododx, edad, sexo, fecha_resultado) VALUES (%s,	%s,	%s,%s,	%s,	%s,%s,	%s)",
                   (uuid, departamento, provincia, distrito, metododx, edad, sexo, fecha_resultado))
    cont = cont + 1
print("#TOTAL %i registros insertado correctamente." % cont)

con.commit()
con.close()
