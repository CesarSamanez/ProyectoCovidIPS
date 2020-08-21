import pymysql
import os
import json

lugaresMarcadores = []

con = pymysql.connect(host='localhost', user='test', passwd='EkMGdb5c', db='data')
cursor = con.cursor()

with open('places.json', encoding='utf-8') as file:
    data = json.load(file)
    for place in data['places']:
        localizacion = place["departamento"]+" " +place["provincia"]+" "+place["distrito"]

        cursor.execute("SELECT COUNT(*) FROM positivos WHERE distrito LIKE '"+place["distrito"]+"'")
        myresult = cursor.fetchone()
        
        cursor.execute("SELECT lat FROM lugares WHERE distrito LIKE '"+place["distrito"]+"'")
        lat = cursor.fetchone()

        cursor.execute("SELECT lng FROM lugares WHERE distrito LIKE '"+place["distrito"]+"'")
        lng = cursor.fetchone()

        if lat is not None or lng is not None:
            lugaresMarcadores.append({'name' : place["distrito"], 'cantidad' : "{}".format(myresult[0]), 'lat' : "{}".format(lat[0]), 'lng' : "{}".format(lng[0])})


con.commit()
con.close()

with open('lugaresMarcadores.json', 'w') as file:
    file.write("places = ")
    json.dump(lugaresMarcadores, file, indent=4)
