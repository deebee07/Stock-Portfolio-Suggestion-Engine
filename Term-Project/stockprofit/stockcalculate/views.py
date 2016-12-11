from django.shortcuts import render
from django.http import HttpResponse
from django.shortcuts import render
from django.shortcuts import render_to_response
from django.http import Http404
import sqlite3

from django.utils import timezone
from django.views.decorators.csrf import ensure_csrf_cookie
from django.views.decorators.csrf import csrf_exempt
import json

from pprint import pprint

def addStock(request):
	return render_to_response("stockcalculate/invest/add-stock.html")



def homepage(request):
	return render_to_response("stockcalculate/index.html")

# def login(request):

# 	return render_to_response("stockcalculate/login.html",{'username':"rajeev"})


def portfolio(request):
	username=request.GET["username"]
	print username
	return render_to_response("stockcalculate/portfolio/portfolio.html",{'username':username})


def marketHome(request):
	return render_to_response("stockcalculate/market/marketHome.html")

def investHome(request):
	username=request.GET["username"]

	return render_to_response("stockcalculate/invest/investHome.html",{'username':username})

def trendHome(request):
	return render_to_response("stockcalculate/trend/trendHome.html")




def investStrategy(request):
	strArr=[]
	username=request.GET["username"]
	with open('investment-strategy/strategy-stock.json') as data_file:
		data = json.load(data_file)

	print data["Investment Strategies"]

	return render_to_response("stockcalculate/invest/investStrategy.html",{'data':data["Investment Strategies"],'username':username})



def investStock(request):
	username=request.GET["username"]
	return render_to_response("stockcalculate/invest/investStock.html",{'username':username})



@csrf_exempt
def addData(request):
	amount= request.POST['amount']
	strategy= request.POST['strategy']
	username=request.GET["username"]
	print amount
	print strategy
	return render_to_response("stockcalculate/addedStocks.html",{'username':username})


@csrf_exempt
def getValue(request):
	error=""
	proceeds=""
	cost=""
	purch_price=""
	buy_comm=""
	sell_comm=""
	tax_on_capital_gain=""
	net_profit=""
	return_investment=""
	final_share_price=""

	try:
		stock_symbol= request.POST['ticker_symbol']
		allotment= request.POST['allotment']
		final_share_price= request.POST['final_share_price']
		sell_commission=request.POST['sell_commission']
		initial_share_price=request.POST['initial_share_price']
		buy_commission=request.POST['buy_commission']
		capital_gain_rate =request.POST['capital_gain_tax']
		if float(allotment) <0:
			raise Exception('Error:', 'Allotment has to be positive')
		if float(final_share_price) <0:
			raise Exception('Error:', 'Final Share Price has to be positive')
		if float(sell_commission) <0:
			raise Exception('Error:', 'Sell Commission should not be negative')
		if float(initial_share_price) <0:
			raise Exception('Error:', 'Initial Share Price should not be negative')
		if float(buy_commission) <0:
			raise Exception('Error:', 'Buy Commission should not be negative')
		if float(capital_gain_rate) <0 or float(capital_gain_rate)>100:
			raise Exception('Error:', 'Capital Gain Rate should be between 0 and 100')
		
		print
		print 'PROFIT REPORT: '
		print 'Proceeds'
		current_value=float(final_share_price)*float(allotment)
		initial_value=float(initial_share_price)*float(allotment)
		cost_price=(float(allotment)* float(final_share_price) - (float(allotment) *float(initial_share_price)) - float(buy_commission) - float(sell_commission))
		str_cost_price=str(cost_price)
		str_cost_price= "$"+str(getComma(cost_price))
		tax_on_capital=float(cost_price)/float(100)*float(capital_gain_rate)
		if tax_on_capital <= 0:
			tax_on_capital= 0.00
		cost=initial_value+float(tax_on_capital)+float(buy_commission)+float(sell_commission)
		net_profit=current_value-cost
		return_on_investment=round((float(net_profit)/float(cost)*float(100)),2)
		cost_of_buy=float(buy_commission)+float(sell_commission)+(float(allotment)*float(initial_share_price))
		stock_price_final=float(cost_of_buy)/float(allotment)

		proceeds= "$"+str(getComma(current_value))
		print
		print 'Cost'
		cost= "$"+str(getComma(cost))
		print
		print 'Cost details:'
		print 'Total Purchase Price'
		purch_price= str(allotment)+" x"+ " $"+str(float(initial_share_price))+ " = "+str(getComma(float(allotment)*float(initial_share_price)))
		buy_comm= "Buy Commission = "+str(float(buy_commission))
		sell_comm= "Sell Commission = "+str(float(sell_commission))
		tax_on_capital_gain= "Tax on Capital Gain = " + str(float(capital_gain_rate))+"% "+"of "+str_cost_price+ " = " +str(getComma(tax_on_capital))
		print
		print "Net Profit"
		net_profit= "$"+str(getComma(net_profit))
		print
		print "Return on Investment"
		return_investment= str(return_on_investment)+"%"
		print
		print "To break even, you should have a final share price of"
		final_share_price= "$"+str(getComma(stock_price_final))

	except Exception as inst:
		error=inst
	return render_to_response("stockcalculate/profitReport.html",{'proceeds':proceeds,'cost':cost,'purch_price':purch_price,'buy_comm':buy_comm,'sell_comm':sell_comm,'tax_on_capital_gain':tax_on_capital_gain,'net_profit':net_profit,'return_investment':return_investment,'final_share_price':final_share_price,'error':error
})

	raise Http404

@csrf_exempt
def login(request):
	connection = sqlite3.connect('login.db')
	cursor=connection.cursor()
	login_user_name=request.GET['loginname']
	login_user_password=request.GET['loginpassword']
	cursor.execute('SELECT Username from login where Username = ?',(login_user_name,))
	try:
		usr=cursor.fetchall()[0][0]
	except Exception as inst:
		return render_to_response("stockcalculate/failure.html")

	if (login_user_name==usr):
		cursor.execute('SELECT Password from login where Username = ?',(login_user_name,))
		pwd=cursor.fetchall()[0][0]
		if (login_user_password==pwd):
			return render_to_response("stockcalculate/login.html",{'username':login_user_name})
		elif (login_user_password!=pwd):
			return render_to_response("stockcalculate/failure.html")
		# print usr
	elif (login_user_name!=usr):
		return render_to_response("stockcalculate/failure.html")

def register(request):

	connection = sqlite3.connect('login.db')
	cursor=connection.cursor()
	user_name=request.GET['name']
	user_email=request.GET['email']
	user_password=request.GET['password']
	user_repassword=request.GET['password1']
	print user_repassword
	try:
		if (user_password==user_repassword):
			cursor.execute('''INSERT INTO login(Username,Email,Password) values(?,?,?)''', (user_name,user_email,user_password))
			connection.commit()
			connection.close()
			return render_to_response("stockcalculate/signup.html")
	except Exception as exp:
		return render_to_response("stockcalculate/passwordmatch.html")
	else:
		return render_to_response("stockcalculate/passwordmatch.html")


def forgot(request):
	return render_to_response("stockcalculate/forgot.html")

def change(request):
	connection = sqlite3.connect('login.db')
	cursor=connection.cursor()
	in_name=request.GET['inname']
	in_email=request.GET['inemail']
	user_pass1=request.GET['password1']
	user_pass2=request.GET['password2']
	cursor.execute('SELECT Username from login where Username = ?',(in_name,))
	try:
		user1=cursor.fetchall()[0][0]
	except Exception as inst:
		return render_to_response("stockcalculate/invaliduser.html")
	if (in_name==user1):
		cursor.execute('SELECT Email from login where Username = ?',(in_name,))
		eml=cursor.fetchall()[0][0]
		if(in_email!=eml):
			return render_to_response("stockcalculate/invalidemail.html")
		elif (in_email==eml and user_pass1==user_pass2):
			cursor.execute("""UPDATE login SET Password = ? WHERE Username= ? """,(user_pass1,in_name,))
			connection.commit()
			connection.close()
			return render_to_response("stockcalculate/index.html")
		else:
			return render_to_response("stockcalculate/passwordmatch.html")

def getComma(f):
    s = str(abs(f))
    decimalposition = s.find(".") 
    if decimalposition == -1:
        decimalposition = len(s)
    comma_to_number = "" 
    for i in range(decimalposition+1, len(s)): 
        if not (i-decimalposition-1) % 3 and i-decimalposition-1: comma_to_number = comma_to_number+","
        comma_to_number = comma_to_number+s[i]      
    if len(comma_to_number):
        comma_to_number = "."+comma_to_number 
    for i in range(decimalposition-1,-1,-1):
        if not (decimalposition-i-1) % 3 and decimalposition-i-1: comma_to_number = ","+comma_to_number
        comma_to_number = s[i]+comma_to_number      
    if f < 0:
        comma_to_number = "-"+comma_to_number
    return comma_to_number




