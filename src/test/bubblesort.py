list2 = [4, 5, 2, 1, 5, 4,2, 8, 7, 9]

temp = []

for i in range(len(list2)):
    for j in range(0, len(list2) - 1):
        if list2[j] > list2[j + 1]:
            list2[j], list2[j + 1] = list2[j + 1], list2[j]


print(list2)  