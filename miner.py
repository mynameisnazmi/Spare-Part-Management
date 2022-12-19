#!C:/Users/NAZMI/AppData/Local/Programs/Python/Python39/python.exe
print("Content-Type: text/html")
print("")
from chefboost import Chefboost as chef
import pandas as pd

df = pd.read_csv("data_history.csv")
dftrain = df.sample(frac=0.7)
dftest = df.drop(dftrain.index)

if __name__ == "__main__":
    config = {"algorithm": "C4.5", "enableParallelism": True, "num_cores": 2}
    model = chef.fit(dftrain, config, "Decision", dftest)

# conmat = []
# conmat.append(sum((dftest["Decision"] == "Yes") & (dftest["Prediction"] == "Yes")))  # TP
# conmat.append(sum((dftest["Decision"] == "No") & (dftest["Prediction"] == "Yes")))  # FP
# conmat.append(sum((dftest["Decision"] == "Yes") & (dftest["Prediction"] == "No")))  # FN
# conmat.append(sum((dftest["Decision"] == "No") & (dftest["Prediction"] == "No")))  # TN
# print(conmat)
