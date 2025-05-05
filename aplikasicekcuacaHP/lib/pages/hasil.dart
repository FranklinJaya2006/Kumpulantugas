import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class Hasil extends StatefulWidget {
  final String isioi;

  const Hasil({super.key,required this.isioi});

  @override
  State<Hasil> createState() => _HasilState();
}

class _HasilState extends State<Hasil> {
  Future<Map<String, dynamic>> getDataFromApi() async {
    try {
    final response = await http.get(Uri.parse("API OpenWeatherMap"));

    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      return data;
    } else {
      throw Exception('Failed to load data');
    }
  } catch (e) {
    print('Error: $e');  // Menampilkan kesalahan di konsol
    throw e;
  }
  }
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        backgroundColor: Colors.white,
        appBar: AppBar(
          leading: GestureDetector(onTap: () {Navigator.pop(context);
          },
          child: const Icon(Icons.arrow_back,color: Colors.white,)
          ),
          title: const Text('Hasil Pencarian', style: TextStyle(color: Colors.white),),
          centerTitle: true,
          backgroundColor: Colors.blueAccent,
        ),
        body: Container(
          padding: const EdgeInsets.symmetric(horizontal: 70),
          child: FutureBuilder(future: getDataFromApi(), builder: (context,snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
                  return const CircularProgressIndicator();
                } else if (snapshot.hasError) {
                  return Text('Error: masukkan nama kota yang tepat');
                } else if (snapshot.hasData) {
                  final data = snapshot.data!;
                  return Container(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        Text("${widget.isioi.toUpperCase()}",style: const TextStyle(fontSize: 40,color: Colors.black),),
                        Text("Suhu kota saat ini mencapai : ${data["main"]["feels_like"]}",style: const TextStyle(fontSize: 15),),
                        Text("Cuaca kota saat ini : ${data["weather"][0]["main"]}",style: const TextStyle(fontSize: 15)),
                        Text("Temperatur max : ${data["main"]["temp_max"]}",style: const TextStyle(fontSize: 15)),
                        Text("Temperatur min : ${data["main"]["temp_min"]}",style: const TextStyle(fontSize: 15))
                      ],
                    ),
                  );
                } else {
                  return const Text('Tidak diketahui');
    }
          }),
        )
      ),
    );
  }
}