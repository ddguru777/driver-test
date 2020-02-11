from selenium import webdriver
from selenium.webdriver.support.ui import Select
from datetime import datetime
import pytz
import mysql.connector

driver = webdriver.Chrome('C:/chromedriver/chromedriver.exe')

mydb=mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="test1"
)
mycursor=mydb.cursor()

mycursor.execute("select * from users")
myresult=mycursor.fetchall()

for x in myresult:
    print(x[1])
    break
def start(license, reference):
    driver.get("https://www.gov.uk/change-driving-test")
    driver.find_element_by_xpath('//*[@id="get-started"]/a').click()
    driver.find_element_by_xpath('//*[@id="driving-licence-number"]').send_keys(license)
    driver.find_element_by_xpath('//*[@id="driving-licence-number"]').send_keys(license)
    driver.find_element_by_xpath('//*[@id="application-reference-number"]').send_keys(reference)
    driver.find_element_by_xpath('//*[@id="booking-login"]').click()
    driver.find_element_by_xpath('//*[@id="test-centre-change"]').click()
    driver.find_element_by_xpath('//*[@id="test-centres-submit"]').click()
    driver.find_element_by_xpath('//*[@id="centre-name-128"]').click()  
    lis = driver.find_element_by_class_name('SlotPicker-days').find_elements_by_tag_name('li')
    suitable_id = None
    found = False
    for li in lis:
        # li.get_attribute('id')
        suitable_id = li.get_attribute('id')
        if len(suitable_id) > 5: # check day is valid
            suitable_id = suitable_id[5:]
            print("suitable_id:", suitable_id)
            tbody = driver.find_element_by_class_name('BookingCalendar-datesBody')
            days = tbody.find_elements_by_tag_name('a')
            for day in days:
                print(day.get_attribute('data-date'))
                if day.get_attribute('data-date') == suitable_id:
                    day.click()
                    labels = li.find_elements_by_tag_name('label')
                    for label in labels:
                        tm = int(label.find_element_by_tag_name('input').get_attribute('value')) / 1000
                        tm = datetime.fromtimestamp(tm, pytz.timezone('Europe/London')).strftime('%H:%M:%S')
                        print(tm)
                        if tm < '15:00:00': #check time is valid
                            label.click()
                            driver.find_element_by_id('slot-chosen-submit').click()
                            html = driver.find_element_by_id('slot-hold-warning').get_attribute('innerHTML')
                            print(html)
                            found = True
                            break
                if found:
                    break
        if found:
            break                                   

start("NABUY956102SK9XW", "42568131")
# //*[@id="date-2019-05-21"]/label[1]/strong
# //*[@id="slot-picker-form"]/div[1]/div[1]/div[2]/table/tbody/tr[2]/td[1]/div/a
# //*[@id="date-2019-05-21"]/label[1]/strong
# //*[@id="date-2019-05-28"]/label[1]/strong
# //*[@id="date-2019-05-22"]/label[1]/strong
# //*[@id="date-2019-05-23"]/label[1]/strong

# //*[@id="slot-picker-form"]/div[1]/div[1]/div[2]/table/tbody/tr[1]/td[1]/div/a
# //*[@id="slot-picker-form"]/div[1]/div[1]/div[2]/table/tbody/tr[1]/td[4]/div/a
# //*[@id="slot-picker-form"]/div[1]/div[1]/div[2]/table/tbody/tr[1]/td[2]/div/a
# //*[@id="test-centre-change"]
# //*[@id="test-centre-change"]

# //*[@id="test-centres-input"]
# //*[@id="test-centres-submit"]

# //*[@id="centre-name-128"]

# //*[@id="slot-picker-form"]/div[1]/div[1]/div[1]/a[1]

# //*[@id="slot-picker-form"]/div[1]/div[1]/div[1]/a[2]

# //*[@id="slot-picker-form"]/div[1]/div[1]/div[2]/table/tbody/tr[4]/td[1]/div/a

a = input()