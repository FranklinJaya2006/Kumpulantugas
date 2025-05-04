class student{
  String? _name;
  int? _stdid;
  int? _grade;

  student(this._name, this._stdid, this._grade);

  String? get name => _name;

  set name(String? value) {
    _name = value;
  }

  int? get stdid => _stdid;

  set stdid(int? value) {
    _stdid = value;
  }

  int? get grade => _grade;

  set grade (int? value) {
    _grade = value;
  }

  void ingfo () {
    print('Name: $_name');
    print('ID: $_stdid');
    print('Grade: $_grade');
  }
}