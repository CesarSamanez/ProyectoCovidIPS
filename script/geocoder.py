from geopy.geocoders import Nominatim
import pymysql
import os
import json

geolocator = Nominatim(user_agent="Geocoding")

con = pymysql.connect(host='localhost', user='test', passwd='EkMGdb5c', db='data')
cursor = con.cursor()

cont = 1
with open('places.json', encoding='utf-8') as file:
    data = json.load(file)
    for place in data['places']:
        localizacion = place["distrito"]+" " +place["provincia"]+" "+place["departamento"]+" Peru"
        try:
            location = geolocator.geocode(localizacion)
            cursor.execute("INSERT INTO lugares (departamento, provincia, distrito, lat, lng) VALUES (%s, %s, %s, %s, %s)",
                           (place["departamento"], place["provincia"], place["distrito"], location.latitude, location.longitude))
            print(cont)
            cont = cont + 1

        except AttributeError:
            print("Localizacion no encontrada")
print("#TOTAL %i registros insertado correctamente." % cont)

con.commit()
con.close()
