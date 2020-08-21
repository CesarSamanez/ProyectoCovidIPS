import pymysql

try:
    # Eliminar registros e insertar nuevos
    conexion = pymysql.Connection(
        host="localhost", user="test", password="EkMGdb5c", db="data")
    cursor = conexion.cursor()
    cursor.execute("DROP TABLE IF EXISTS positivos")
    # Cierre de conexion
    conexion.close()
    cursor.close()

    # Eliminar registros e insertar nuevos
    conexion = pymysql.Connection(
        host="localhost", user="test", password="EkMGdb5c", db="data")
    cursor = conexion.cursor()
    cursor.execute("DROP TABLE IF EXISTS pruebas")
    # Cierre de conexion
    conexion.close()
    cursor.close()
    
    # Abrir conexion
    conexion = pymysql.Connection(
        host="localhost", user="test", password="EkMGdb5c", db="data")
    cursor = conexion.cursor()
    # Creacion tablas de registros positivos
    cursor.execute("CREATE TABLE `data`.`positivos` (`uuid` VARCHAR(60) NULL, `departamento` VARCHAR(60) NULL, `provincia` VARCHAR(100) NULL, `distrito` VARCHAR(100) NULL, `metododx` VARCHAR(50) NULL, `edad` VARCHAR(20) NULL, `sexo` VARCHAR(20) NULL, `fecha_resultado` VARCHAR(10) NULL)")
    conexion.commit()
    conexion.close()

    # Abrir conexion
    conexion = pymysql.Connection(
        host="localhost", user="test", password="EkMGdb5c", db="data")
    cursor = conexion.cursor()
    # Creacion tablas de registros positivos
    cursor.execute("CREATE TABLE `data`.`pruebas` (`fecha` date NULL, `cantidad` int(11) NULL, contagios int(11) NULL)")
    conexion.commit()
    conexion.close()


except:
    print("Base de datos y/o tablas ya existen...")
