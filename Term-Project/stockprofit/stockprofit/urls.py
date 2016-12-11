"""stockprofit URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/1.10/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  url(r'^$', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  url(r'^$', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.conf.urls import url, include
    2. Add a URL to urlpatterns:  url(r'^blog/', include('blog.urls'))
"""
from django.conf.urls import url
from django.contrib import admin
from django.conf.urls import include
from stockcalculate.views import getValue,investStrategy,addData,homepage,login,portfolio,marketHome, investHome,trendHome,addStock,investStock,register,change,forgot


urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^$',homepage,name='homepage'), #Homepage of Website
    url(r'login$',login,name='login'), #Logged in user Home
    url(r'signup$',register,name='register'),
    url(r'forgot$',forgot,name='forgot'),
    url(r'change$',change,name='change'),

#PORTFOLIO
#url(r'portfolio/(?P<username>[\w\-]+)/$',portfolio,name='portfolio'),
url(r'portfolio$',portfolio,name='portfolio'),

#MARKET
url(r'market$',marketHome,name='marketHome'),


#INVEST
url(r'invest$',investHome,name='investHome'),
    url(r'investstock$',investStock,name='investStock'),
    url(r'investstrategy$',investStrategy,name='investMoney'),
    url(r'addstock$',addStock,name='addStock'), #Invest Pre-existing Stock

#TREND
     url(r'trend$',trendHome,name='trendHome'), #Investment Trends taken from whole of MongoDB

    

    url(r'getvalue$',getValue,name='getValue'),
    url(r'adddata$',addData,name='addData'),
]
