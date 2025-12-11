class Person:
    def __init__(self, name, age):  # Конструктор
        self.name = name            # Атрибут объекта
        self.age = age

    def greet(self):                # Метод объекта
        print(f"Привет, меня зовут {self.name}, мне {self.age} лет.")

# Создание объекта (экземпляра класса)
p1 = Person("Анна", 25)

# Вызов метода
p1.greet()



class Student(Person):
    def __init__(self, name, age, grade):
        super().__init__(name, age)  # вызываем конструктор родителя
        self.grade = grade

    def show_info(self):
        print(f"{self.name} учится в {self.grade} классе.")

s1 = Student("Игорь", 17, 11)
s1.greet()
s1.show_info()