package xiaoming


import org.apache.spark.sql.SparkSession


object RunRDF {

  case class Person(name: String, age: Long)

  def main(args: Array[String]): Unit = {
    val spark = SparkSession
      .builder()
      .appName("Spark SQL basic example")
      .config("spark.some.config.option", "some-value")
      .getOrCreate()

    val df = spark.read.json("E:\\sparkdata/people.json")

    // Displays the content of the DataFrame to stdout
    df.show()
    import spark.implicits._
    // Print the schema in a tree format
    df.printSchema()


    df.select("name").show()

    df.select($"name", $"age" + 1).show()

    df.filter($"age" > 21).show()

    // Count people by age
    df.groupBy("age").count().show()
    df.createOrReplaceTempView("people")

    val sqlDF = spark.sql("SELECT * FROM people")
    sqlDF.show()
    df.createGlobalTempView("people")

    spark.sql("SELECT * FROM global_temp.people").show()


    // Global temporary view is cross-session
//    spark.newSession().sql("SELECT * FROM global_temp.people").show()


    // Encoders are created for case classes
    val caseClassDS = Seq(Person("Andy", 32)).toDS()
    caseClassDS.show()


    val primitiveDS = Seq(1, 2, 3).toDS()
    primitiveDS.show()
    //
    //    primitiveDS.map(_ + 1).collect() // Returns: Array(2, 3, 4)
    //
    //    val path = "E:\\sparkdata/people.json"
    //    val peopleDS = spark.read.json(path).as[Person]
    //    peopleDS.show()
    val peopleDF = spark.sparkContext
      .textFile("E:\\sparkdata/people.txt")
      .map(_.split(","))
      .map(attributes => Person(attributes(0), attributes(1).trim.toInt))
      .toDF()
    peopleDF.createOrReplaceTempView("people")

    val teenagersDF = spark.sql("SELECT name, age FROM people WHERE age BETWEEN 13 AND 19")


    teenagersDF.map(teenager => "Name: " + teenager(0)).show()


    // or by field name
    teenagersDF.map(teenager => "Name: " + teenager.getAs[String]("name")).show()

    implicit val mapEncoder = org.apache.spark.sql.Encoders.kryo[Map[String, Any]]
    // Primitive types and case classes can be also defined as
    // implicit val stringIntMapEncoder: Encoder[Map[String, Any]] = ExpressionEncoder()

    // row.getValuesMap[T] retrieves multiple columns at once into a Map[String, T]
    teenagersDF.map(teenager => teenager.getValuesMap[Any](List("name", "age"))).collect()

    println("3333")
    //    val rdd2 = sc.textFile("D://covtype2.data") //创建RDD文件路径
    //      .map(_.split(' ') //按“ ”分割
    //      .map(_.toDouble)) //转成Double类型
    //    var rdd3 = rdd2.map(a=>a.sum)
    //    rdd3.foreach(println )

    //    val rdd = sc.textFile("D://covtype2.data") //创建RDD文件路径
    //      .map(_.split(' ') //按“ ”分割
    //      .map(_.toDouble)) //转成Double类型
    //      .map(line => Vectors.dense(line)) //转成Vector格式
    //    val rm = new RowMatrix(rdd) //读入行矩阵
    //    println(rm.numRows()) //打印列数
    //    println(rm.numCols()) //打印行数
    //    rm.rows.foreach(println)


    //    // Split into 80% train, 10% cross validation, 10% test
    //    val Array(trainData, cvData, testData) = data.randomSplit(Array(0.8, 0.1, 0.1))
    //    trainData.cache()
    //    cvData.cache()
    //    testData.cache()
    //
    //    simpleDecisionTree(trainData, cvData)
    //    randomClassifier(trainData, cvData)
    //    evaluate(trainData, cvData, testData)
    //    evaluateCategorical(rawData)
    //    evaluateForest(rawData)
    //
    //    trainData.unpersist()
    //    cvData.unpersist()
    //    testData.unpersist()
  }

}