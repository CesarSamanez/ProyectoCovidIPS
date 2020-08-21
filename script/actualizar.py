# encoding: utf-8
import pymysql
import csv

connection = pymysql.connect(host='localhost', user='test',
                      passwd='EkMGdb5c', db='data')


fechas=['20200811']

departamentos=['AMAZONAS','ANCASH','APURIMAC','AREQUIPA','AYACUCHO','CAJAMARCA','CALLAO','CUSCO','HUANCAVELICA','HUANUCO','ICA','JUNIN','LA LIBERTAD','LAMBAYEQUE','LIMA REGION','LORETO',
'MADRE DE DIOS','MOQUEGUA','PASCO','PIURA','PUNO','SAN MARTIN','TACNA','TUMBES','UCAYALI']

provincias=[['BAGUA','BONGARA','CHACHAPOYAS','CONDORCANQUI','LUYA','RODRIGUEZ DE MENDOZA','UTCUBAMBA']
,['AIJA','ANTONIO RAIMONDI','ASUNCION','BOLOGNESI','CARHUAZ','CARLOS FERMIN FITZCARRALD','CASMA','CORONGO','HUARAZ','HUARI','HUARMEY','HUAYLAS','MARISCAL LUZURIAGA','OCROS','PALLASCA','POMABAMBA','RECUAY','SANTA','SIHUAS','YUNGAY']
,['ABANCAY','ANDAHUAYLAS','ANTABAMBA','AYMARAES','CHINCHEROS','COTABAMBAS','GRAU']
,['AREQUIPA','CAMANA','CARAVELI','CASTILLA','CAYLLOMA','CONDESUYOS','ISLAY','LA UNION']
,['CANGALLO','HUAMANGA','HUANCA SANCOS','HUANTA','LA MAR','LUCANAS','PARINACOCHAS','PAUCAR DEL SARA SARA','SUCRE','VICTOR FAJARDO','VILCAS HUAMAN']
,['CAJABAMBA','CAJAMARCA','CELENDIN','CHOTA','CONTUMAZA','CUTERVO','HUALGAYOC','JAEN','SAN IGNACIO','SAN MARCOS','SAN MIGUEL','SAN PABLO','SANTA CRUZ']
,['CALLAO']
,['ACOMAYO','ANTA','CALCA','CANAS','CANCHIS','CHUMBIVILCAS','CUSCO','ESPINAR','LA CONVENCION','PARURO','PAUCARTAMBO','QUISPICANCHI','URUBAMBA']
,['ACOBAMBA','ANGARAES','CASTROVIRREYNA','CHURCAMPA','HUANCAVELICA','HUAYTARA','TAYACAJA']
,['AMBO','DOS DE MAYO','HUACAYBAMBA','HUAMALIES','HUANUCO','LAURICOCHA','LEONCIO PRADO','MARAÑON','PACHITEA','PUERTO INCA','YAROWILCA']
,['CHINCHA','ICA','NAZCA','PALPA','PISCO']
,['CHANCHAMAYO','CHUPACA','CONCEPCION','HUANCAYO','JAUJA','JUNIN','SATIPO','TARMA','YAULI']
,['ASCOPE','BOLIVAR','CHEPEN','GRAN CHIMU','JULCAN','OTUZCO','PACASMAYO','PATAZ','SANCHEZ CARRION','SANTIAGO DE CHUCO','TRUJILLO','VIRU']
,['CHICLAYO','FERREÑAFE','LAMBAYEQUE']
,['LIMA','LIMA REGION','BARRANCA','CAJATAMBO','CANETE','CANTA','HUARAL','HUAROCHIRI','HUAURA','OYON','YAUYOS',]
,['ALTO AMAZONAS','DATEM DEL MARAÑON','LORETO','MARISCAL RAMON CASTILLA','MAYNAS','PUTUMAYO','REQUENA','UCAYALI']
,['MANU','TAHUAMANU','TAMBOPATA']
,['GENERAL SANCHEZ CERRO','ILO','MARISCAL NIETO']
,['DANIEL ALCIDES CARRION','OXAPAMPA','PASCO']
,['AYABACA','HUANCABAMBA','MORROPON','PAITA','PIURA','SECHURA','SULLANA','TALARA']
,['AZANGARO','CARABAYA','CHUCUITO','EL COLLAO','HUANCANE','LAMPA','MELGAR','MOHO','PUNO','SAN ANTONIO DE PUTINA','SAN ROMAN','SANDIA','YUNGUYO']
,['BELLAVISTA','EL DORADO','HUALLAGA','LAMAS','MARISCAL CACERES','MOYOBAMBA','PICOTA','RIOJA','SAN MARTIN','TOCACHE']
,['CANDARAVE','JORGE BASADRE','TACNA','TARATA']
,['CONTRALMIRANTE VILLAR','TUMBES','ZARUMILLA',]
,['ATALAYA','CORONEL PORTILLO','PADRE ABAD','PURUS']]

print(provincias[0])
aux='"'

i=0
fp = open('positivosReg.csv', 'w')
myFile = csv.writer(fp)
myFile.writerow(["fecha","cantidad","departamento","provincia"])
for fecha in fechas:
    for departamento in departamentos:
        for provincia in provincias[i]:
                cursor = connection.cursor()  # to access field as dictionary use cursor(as_dict=True)
                cursor.execute("SELECT COUNT(uuid) FROM positivos WHERE departamento='"+departamento+"' AND provincia='"+provincia+"' AND fecha_resultado<='"+fecha+"'")
                row=[fecha,(str(tuple(cursor.fetchone()))).lstrip('"').lstrip("(").strip('"').strip(")").strip(","),departamento,provincia]
                myFile.writerow(row)
                print(provincia+"##########################")
        i = i + 1
        print(departamento+"#################################################################")
    i=0
    print(fecha+"########################################################################################################")

fp.close()


