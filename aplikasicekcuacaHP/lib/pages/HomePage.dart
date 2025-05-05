import 'package:flutter/material.dart';
import 'package:weather/pages/hasil.dart';

class MainPage extends StatefulWidget {
  const MainPage({super.key});

  @override
  State<MainPage> createState() => _MainPageState();
}

class _MainPageState extends State<MainPage> {
  @override
  Widget build(BuildContext context) {
    TextEditingController isi = TextEditingController();
    final tinggi = MediaQuery.of(context).size;
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        backgroundColor: Colors.blueAccent,
        centerTitle: true,
        title: const Text(
          "Tracking cuaca",
          style: TextStyle(color: Colors.white),
        ),
      ),
      body: Center(
          child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Image.asset(
            "assets/weather.png",
            height: tinggi.height / 3.25,
          ),
          const SizedBox(
            height: 10,
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 40),
            child: TextField(
              decoration: const InputDecoration(
                hintText: "Cari keadaan kota / negara",
              ),
              controller: isi,
            ),
          ),
          const SizedBox(
            height: 30,
          ),
          ElevatedButton(
              onPressed: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) {
                  return Hasil(isioi: isi.text,);
                })
                );
                // print(isi.text);
              },
              child: const Text(
                "Cari",
                style: TextStyle(color: Colors.black),
              )
              )
        ],
      )),
    );
  }
}
