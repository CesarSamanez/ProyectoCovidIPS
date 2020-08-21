# encoding: utf-8
import pymysql
import os
import json

# read JSON file which is in the next parent folder
file = 'positivosRegJSON.json'
json_data = open(file).read()
json_obj = json.loads(json_data)

# do validation and checks before insert


def validate_string(val):
    if type(val) is int:
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
    fecha = validate_string(item.get("fecha"))
    cantidad = validate_string(item.get("cantidad"))
    departamento = validate_string(item.get("departamento"))
    provincia = validate_string(item.get("provincia"))

    cursor.execute("INSERT INTO pruebas_region (fecha, cantidad, departamento, provincia) VALUES ('"+fecha+"','"+cantidad+"','"+departamento+"','"+provincia+"')")
    cont = cont + 1

print("#TOTAL %i registros insertado correctamente." % cont)

con.commit()
con.close()
