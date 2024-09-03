import xml.dom.minidom as minidom
import mysql.connector

connection = mysql.connector.connect(host='localhost', user='root', password='123', database='hw7')
cursor = connection.cursor()
    
queryOne = "DELETE FROM products";
queryTwo = "ALTER TABLE products AUTO_INCREMENT = 1";
cursor.execute(queryOne);
cursor.execute(queryTwo);
connection.commit();

# Canon page webscraping
for i in range(1, 21):
    
    document = minidom.parse('vendorOne_' + str(i) + '.xhtml')
    
    # scrape product name
    for tag in document.getElementsByTagName('span'):
        if tag.hasAttribute('class'):
            classes = tag.getAttribute('class').split()
            if 'base' in classes:
                name = tag.firstChild.data.strip()
                break
    
    # scrape product price
    for tag in document.getElementsByTagName('span'):
        if tag.hasAttribute('class'):
            classes = tag.getAttribute('class').split()
            if 'price' in classes:
                price = tag.firstChild.data
                break
        
    # scrape product description
    for tag in document.getElementsByTagName('p'):
        if 'overview-product' in tag.parentNode.getAttribute('class').split():
            descrip = tag.firstChild.nodeValue if tag.firstChild != None else "" 
    
    # scrape product img url
    for tag in document.getElementsByTagName('img'):
        if tag.getAttribute('class') == 'gallery-placeholder__image':
            img_url = tag.getAttribute('src')
            break
    
    query = "INSERT INTO products (name, price, img_url, description) VALUES (%s, %s, %s, %s)"
    values = (name, price, img_url, descrip)
    cursor.execute(query, values)
    connection.commit()

# Samy's Camera web scraping
for i in range(1, 21):
    
    document = minidom.parse('vendorTwo_' + str(i) + '.xhtml')
    
    # scrape product name
    for tag in document.getElementsByTagName('h1'):
        if tag.getAttribute('class') == 'header':
            name = tag.firstChild.data.strip()
            break
    
    # scrape product price
    for tag in document.getElementsByTagName('div'):
        if 'price' in tag.getAttribute('class').split():
            price = tag.firstChild.nodeValue
            break

    # scrape description
    for tag in document.getElementsByTagName('span'):
        if tag.parentNode.getAttribute('id') == 'productDetailDescription':
            descrip = tag.lastChild.nodeValue
            break

    # scrape img
    for tag in document.getElementsByTagName('img'):
        if 'imagesproc' in tag.getAttribute('src'):
            img_url = 'https://www.samys.com' + tag.getAttribute('src')
            break

    query = "INSERT INTO products (name, price, img_url, description) VALUES (%s, %s, %s, %s)"
    values = (name, price, img_url, descrip)
    cursor.execute(query, values)
    connection.commit()


cursor.close()
connection.close()
