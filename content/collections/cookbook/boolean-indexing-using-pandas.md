---
title: 'Boolean indexing using Pandas'
intro: |
  This page is a quick reference for exploring data using Boolean indexing in Pandas. Remember that a boolean operation returns only True or False, and can only be performed against a series.
  
  Using booleans in data is usually a two-step process: the first step is to evaluate the series and identify which cell is true and which is false relative to the given boolean. The second step is to filter the series based on  the boolean result.
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1608837042
id: 86f77b45-d143-4e90-b1a0-86aaa45c3a80
---
## Operators

|Operator | Description |
| ----------- | ----------- |
|`== a` | `True` if `a` is `True`, else `False`|
|`~a`| `True` if `a` is `False` else `False` (Not a) |
|`a > b`| `True` if `a` is greater than `b` else `False`|
|`a < b`| `True` if `a` is less than `b` else `False`|
|`a & b`| True if both `a` and `b` are `True`, else `False`|
|`a | b`| True if either `a` or `b` is `True`. `False` if both are `False`|



## Filtering a dataframe

Consider the following simple dataframe, which samples four people associated with the number of times the person has seen Star Wars:

![boolean 1](/img/cookbook/python/boolean1.png)

Let's establish a boolean to evaluate which people have see the film fewer than 10 times?

```python
evaluation = df['number'] < 10
```
What this does is evaluate every entry in the column 'number', compare it with the boolean, and place the result in the series "evaluation." Now we have evaluation, a series that evaluates the truthiness of the boolean

![boolean 2](/img/cookbook/python/boolean2.png)

The second step is to use this true/false evaluation as a filter, creating a new series populated by values that are true.

```python
deprived_persons = df['evaluation']
```
![boolean 3](/img/cookbook/python/boolean3.png)

Now we have a new series called deprived\_persons that contains two rows. If we like, we can filter just one column:

```python
deprived_persons = df['evaluation', "name"]
```

## Selecting specific data

Select all rows whose country value is either Brazil or Venezuela

brazil_venezuela = f500[(f500["country"] == "Brazil") | (f500["country"] == "Venezuela")]

Select the first five companies in the Technology sector for which the country is not the Germany

outside_Germany = df[ ~(df["country"] == "Germany") & (df["sector"] == "Technology")].head(5)


## Changing values based on a boolean index

We can change the value in cells that identify as True in a boolean. For example,