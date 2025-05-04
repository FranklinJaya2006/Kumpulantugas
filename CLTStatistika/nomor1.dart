import 'dart:io';

import 'class.dart';

void main () {
  print("Masukkan nama mahasiswa : ");
  String? name = stdin.readLineSync();

  print("Masukkan ID Mahasiswa : ");
  int stdid = int.parse(stdin.readLineSync()!);

  print("Masukkan nilai Mata Kuliah : ");
  int grade = int.parse(stdin.readLineSync()!);

  student murid = new student(name, stdid, grade);

  if (grade >= 70) {
    print("Lulus");
    murid.ingfo();
  } else if (grade < 70) {
    print("gagal");
    murid.ingfo();
  }
}