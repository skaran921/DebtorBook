class Debtor {
  String debtorId;
  String fullName;
  String mobile;
  String email;
  String address;
  String createDate;
  String updateDate;
  Debtor.forCreate(
      {this.debtorId = "",
      required this.fullName,
      required this.mobile,
      required this.email,
      required this.address,
      this.createDate = "",
      this.updateDate = ""});

  Debtor(
    this.debtorId,
    this.fullName,
    this.mobile,
    this.email,
    this.address,
    this.createDate,
    this.updateDate,
  );

  factory Debtor.fromJson(Map<String, dynamic> json) {
    return Debtor(json['DEBTOR_NAME'], json["DEBTOR_MOBILE"], json["DEBTOR_EMAIL"], json['DEBTOR_ADDRESS'],
        json['DEBTOR_CREATE_DATE'], json['DEBTOR_UPDATE_DATE'], json['DEBTOR_ID']);
  }

  Map<String, dynamic> toJson() {
    return {
      "DEBTOR_ID": this.debtorId,
      "DEBTOR_NAME": this.fullName,
      "DEBTOR_MOBILE": this.mobile,
      "DEBTOR_EMAIL": this.email,
      "DEBTOR_ADDRESS": this.address
    };
  }
}
