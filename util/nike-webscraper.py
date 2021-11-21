from bs4 import BeautifulSoup
from urllib.request import urlopen
import requests
from os.path  import basename
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="hunter",
  password="password",
  database="Store"
)

url = "https://www.nike.com/w/womens-skateboarding-shoes-5e1x6z8mfrfzy7ok"
page = urlopen(url)
html = page.read().decode("utf-8")
soup = BeautifulSoup(html, "html.parser")

imgs = soup.find_all('img', { "class": 'product-card__hero-image'})

gender = "Women"
type = "Skateboard"
brand = "Nike"
for product in soup.find_all("div", { "class": 'product-card'})[:5]:
        name = product.find("div", {"class": 'product-card__title'}).text
        description = product.find("div", {"class": 'product-card__subtitle'}).text
        price = product.find("div", {"class": 'product-price'}).text[1:]
        img = product.select("img[src^=https]")[0]["src"]
        lnk = basename(img)
        mycursor = mydb.cursor()
        print(price)

        sql = "INSERT INTO Products (pname, pdescription, price, pbrand, pgender, ptype, pimage) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        val = (name, description, price, brand, gender, type, lnk)
        mycursor.execute(sql, val)

        mydb.commit()
        print(f"{name} {description} {price} {lnk}")
        with open("../mysql_data/images/" + lnk, "wb") as f:
            f.write(requests.get(img).content)