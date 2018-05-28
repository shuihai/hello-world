package xiaoming

import java.util.Properties

import kafka.javaapi.producer.Producer
import kafka.producer.{KeyedMessage, ProducerConfig}
import kafka.serializer.StringDecoder
import org.apache.spark.SparkConf
import org.apache.spark.streaming.kafka.KafkaUtils
import org.apache.spark.streaming.{Seconds, StreamingContext}
import net.sf.json.JSONObject

import scala.util.Random

//bin/kafka-console-consumer.sh --bootstrap-server localhost:9092 --topic user_events --from-beginning
object UserClickCountAnalytics {

  def main(args: Array[String]): Unit = {
    println("333333333")
    var masterUrl = "local[1]"
    if (args.length > 0) {
      masterUrl = args(0)
    }

    // Create a StreamingContext with the given master URL
    val conf = new SparkConf().setMaster(masterUrl).setAppName("UserClickCountStat")
    val ssc = new StreamingContext(conf, Seconds(5))

    // Kafka configurations
    val topics = Set("user_events")
    val brokers = "192.168.100.130:9092"
    val kafkaParams = Map[String, String](
      "metadata.broker.list" -> brokers, "serializer.class" -> "kafka.serializer.StringEncoder")

    val dbIndex = 1
    val clickHashKey = "app::users::click"

    // Create a direct stream
    val kafkaStream = KafkaUtils.createDirectStream[String, String, StringDecoder, StringDecoder](ssc, kafkaParams, topics)

    val events = kafkaStream.flatMap(line => {
      val data = JSONObject.fromObject(line._2)
      Some(data)
    })
//    // Compute user click times
    val userClicks = events.map(x => (x.getString("uid"), x.getInt("click_count"))).reduceByKey(_ + _)
    userClicks.foreachRDD(rdd => {

      rdd.foreachPartition(partitionOfRecords => {

        partitionOfRecords.foreach(pair => {
          val uid = pair._1
          println(uid)
          val clickCount = pair._2
          println(clickCount)
        })


//        val jedis = RedisClient.pool.getResource
//        jedis.select(dbIndex)
//        partitionOfRecords.foreach(pair => {
//          val uid = pair._1
//          val clickCount = pair._2
//          jedis.hincrBy(clickHashKey, uid, clickCount)
//          RedisClient.pool.returnResource(jedis)
//        })
      })
    })

    ssc.start()
    ssc.awaitTermination()







  }

}