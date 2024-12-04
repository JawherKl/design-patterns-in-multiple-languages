Template Method is a behavioral design pattern that allows you to define a skeleton of an algorithm in a base class and let subclasses override the steps without changing the overall algorithm’s structure.




In this example, the Template Method pattern defines a skeleton of the algorithm of message posting to social networks. Each subclass represents a separate social network and implements all the steps differently, but reuses the base algorithm.