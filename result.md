## 上海用户分析

#### 对象数据
- city_name_cn为上海的用户数据

#### 数据可视化工具
- ECHARTS

#### 处理方法
- 按日期排序
- 对全平台pv和uv分别进行展现
- 计算pv/uv，并进行展现
- 按平台划分，查看pv和uv

#### 结论
- pv和uv整体较为平稳，平均每个uv点击pv数为10左右
- pv和uv在一月底时有个低谷，原因预估为春节
![image](https://github.com/parallel-kevin/data/raw/master/snapshots/上海pv图.png)
![image](https://github.com/parallel-kevin/data/raw/master/snapshots/上海uv图.png)
![image](https://github.com/parallel-kevin/data/raw/master/snapshots/上海pv-uv图.png)
- 平台方面app平台uv最少，但pv最多，原因预估为手机使用较为方便
- 三月底至四月中，web平台uv数量出现大幅增加，但pv波动不大，原因预估为与其他平台出现某种合作
![image](https://github.com/parallel-kevin/data/raw/master/snapshots/上海pv平台分布图.png)
![image](https://github.com/parallel-kevin/data/raw/master/snapshots/上海uv平台分布图.png)


#### 问题和反思
- 一开始sql语句写错了，导致选取数据有问题，绘制出的图表总体分布与分平台分布密度不同
- 代码完全没有分离，结构一团糟
- 分析内容较少