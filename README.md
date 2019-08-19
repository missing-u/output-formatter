####  公共输出

### 关于分页
```

为了性能　 新写接口　返回的总条数不再准确

返回总条数的逻辑

假设接收到的　页码　是 3(第三页) 每页的数量是 20
如果查询到的结果是　20 条
　则返回的是　(3+1) * 20

如果查询到的结果小于　20 条
　则返回的是　(3) * 20  

目前的前端并不展示具体的条数　只是根据条数计算出页数

可能后期的优化方案是　不再返回条数 返回的是　是否存在下一页参数

(暂未处理边界情况 即总共　60条　但是实际逻辑返回的是　4页)

```