import mysql.connector
from PIL import Image
with Image.open("pju.jpeg") as im:
    im.show()

csx = mysql.connector.connect(user='root',password='', host='127.0.0.1',database='dbdayapju2')
cursor = csx.cursor()

query = ("SELECT gambar_monitoring_pju FROM monitoring_pju")
cursor.execute(query)
result = cursor.fetchall()
print(result)
