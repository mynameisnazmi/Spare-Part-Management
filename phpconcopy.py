import sys
import pandas as pd

sys.path.insert(0, "C:/xampp/htdocs/spr_mgmt/outputs/rules")
from rules import findDecision

df = pd.read_csv("sample-test.csv")

for i in range(len(df)):
    data1 = df.loc[i, "part_names"]
    data2 = int(df.loc[i, "lifetime"])
    data3 = int(df.loc[i, "load_cap"])
    data4 = int(df.loc[i, "load_act"])
    data5 = int(df.loc[i, "temp_act"])
    result = findDecision([data1, data2, data3, data4, data5])
    print(result)
