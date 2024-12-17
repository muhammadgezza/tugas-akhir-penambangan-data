import pandas as pd
import datetime
from datetime import date, timedelta
import matplotlib.pyplot as plt    
plt.style.use('fivethirtyeight') 
from statsmodels.tsa.seasonal import seasonal_decompose
from statsmodels.tsa.arima_model import ARIMA
from statsmodels.graphics.tsaplots import plot_pacf
import statsmodels.api as sm
import warnings

data = pd.read_csv("")
print(data.head())

#Melihat Pendapatan perhari
import plotly.express as px
figure = px.line(data, x="time", y="pendapatan", tittle="Pendapatan Penjualan PerHari")
figure.show()

#mengecek sifat data
result = seasonal_decompose(data["pendapatan"], model='multiplicative', period=30)
fig = plt.figure()
fig = result.plot()
fig.set_size_inches(15,10)

#menggunakan arima
#mencari nilai p dan q
# mencari nilai p menggunakan plot autokorelasi
pd.plotting.autocorrelation_plot(data["pendapatan"])
d = 1 #karna sesional
p = 1 #karna memotong

## mencari nilai p menggunakan plot autokorelasi parsial
plot_pacf(data["pendapatan"], lags = 20)
q = 2
#model arima
from statsmodels.tools.sm_exceptions import ConvergenceWarning
Warning.simplefilter('ignore',ConvergenceWarning)
model = sm.tsa.statespace.ARIMA(data["pendapatan"],
                                    order=(p,d,q),
                                    seasonal_order=(p,d,q,12))
model = model.fit()
print(model.summary())

#perkiraan pendapatan 2 bulan ke depan
predictions = model.predict(len(data), len(data)+1)
print(predictions)

#menampilkan grafprediksi
data["pendapatan"].plot(legend=True,
                        Label="Pendapatan awal",
                        figsize=(15,10))
predictions.plot(Legend=True, Label="Prediksi")
