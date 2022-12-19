import sys

data1 = sys.argv[1]
data2 = int(sys.argv[2])
data3 = int(sys.argv[3])
data4 = int(sys.argv[4])
data5 = int(sys.argv[5])

sys.path.insert(0, "C:/xampp/htdocs/spr_mgmt/outputs/rules")

from rules import findDecision

result = findDecision([data1, data2, data3, data4, data5])

print(result)
