# encoding: utf-8
import pymysql
import csv

connection = pymysql.connect(host='localhost', user='test',
                      passwd='EkMGdb5c', db='data')


fechas=['20200811']

departamentos=['AMAZONAS','ANCASH','APURIMAC','AREQUIPA','AYACUCHO','CAJAMARCA','CALLAO','CUSCO','HUANCAVELICA','HUANUCO','ICA','JUNIN','LA LIBERTAD','LAMBAYEQUE','LIMA','LIMA REGION','LORETO',
'MADRE DE DIOS','MOQUEGUA','PASCO','PIURA','PUNO','SAN MARTIN','TACNA','TUMBES','UCAYALI']


aux='"'

i=0
fp = open('positivosDep.csv', 'w')
myFile = csv.writer(fp)
myFile.writerow(["fecha","cantidad","departamento"])
for fecha in fechas:
    for departamento in departamentos:
        cursor = connection.cursor()  # to access field as dictionary use cursor(as_dict=True)
        cursor.execute("SELECT COUNT(uuid) FROM positivos WHERE departamento='"+departamento+"' AND fecha_resultado<='"+fecha+"'")
        row=[fecha,(str(tuple(cursor.fetchone()))).lstrip('"').lstrip("(").strip('"').strip(")").strip(","),departamento]
        myFile.writerow(row)
        print('----------------------------------------')
        i = i + 1
        print('----------------------------------------------------------------------')
    i=0
    print(i)

fp.close()


