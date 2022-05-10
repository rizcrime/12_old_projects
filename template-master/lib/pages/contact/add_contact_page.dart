import 'package:flutter/material.dart';
import 'package:template/blocs/contact/contact_bloc.dart';
import 'package:template/blocs/global_bloc.dart';
import 'package:template/models/Contact.dart';
import 'package:template/utils/global_function.dart';
import 'package:template/utils/validator.dart';
import 'package:template/widgets/base_container_widget.dart';
import 'package:template/widgets/custom_text_form_field_widget.dart';
import 'package:template/widgets/loading_widget.dart';
class AddContactPage extends StatefulWidget {
  Contact contact = Contact();
  ContactBloc contactBloc;
  bool isValid;
  AddContactPage({this.contact,this.contactBloc,this.isValid});
  @override
  _AddContactPageState createState() => _AddContactPageState();
}

class _AddContactPageState extends State<AddContactPage> with ValidationMixin{
  GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  FocusNode _nameFocusNode = FocusNode();
  FocusNode _companyFocusNode = FocusNode();
  FocusNode _positionFocusNode = FocusNode();
  FocusNode _addressFocusNode = FocusNode();
  FocusNode _phoneFocusNode = FocusNode();
  FocusNode _emailFocusNode = FocusNode();

  TextEditingController _nameController;
  TextEditingController _companyController;
  TextEditingController _positionController;
  TextEditingController _addressController;
  TextEditingController _phoneController;
  TextEditingController _emailController;

  ContactBloc contactBloc;

  @override
  void initState() {
    _nameController = TextEditingController(text: widget.contact?.contactName);
    _companyController = TextEditingController(text: widget.contact?.contactCompany);
    _positionController = TextEditingController(text: widget.contact?.contactDivision);
    _addressController = TextEditingController(text: widget.contact?.contactAddress);
    _phoneController = TextEditingController(text: widget.contact?.contactNumber);
    _emailController = TextEditingController(text: widget.contact?.contactEmail);

    contactBloc = widget.contactBloc;
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Stack(
      children: <Widget>[
        Scaffold(
          appBar: AppBar(
            title: Text("Add"),
            actions: <Widget>[
              widget.isValid ? InkWell(
                onTap: () => contactBloc.onSave(_formKey, widget.contact),
                child: Padding(
                  padding: const EdgeInsets.symmetric(horizontal:15.0),
                  child: Icon(Icons.save),
                ),
              ):Container(),
            ],
          ),
          body: BaseContainerWidget(
            child: Form(
              key: _formKey,
              child: ListView(
                padding: EdgeInsets.all(10),
                children: <Widget>[
                  Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(10),
                      color: Colors.white,
                    ),
                    padding: EdgeInsets.all(10),
                    child: Column(
                      children: <Widget>[
                        CustomTextFormFieldWidget(
                          readOnly: !widget.isValid,
                          labelText: "Name",
                          focusNode: _nameFocusNode,
                          nextFocusNode: _companyFocusNode,
                          textEditingController: _nameController,
                          validator: validateRequired,
                          onSaved: contactBloc.saveName,
                        ),
                        CustomTextFormFieldWidget(
                          readOnly: !widget.isValid,
                          labelText: "Company",
                          focusNode: _companyFocusNode,
                          nextFocusNode: _positionFocusNode,
                          textEditingController: _companyController,
                          validator: validateRequired,
                          onSaved: contactBloc.saveCompany,
                        ),
                        CustomTextFormFieldWidget(
                          readOnly: !widget.isValid,
                          labelText: "Position",
                          focusNode: _positionFocusNode,
                          nextFocusNode: _addressFocusNode,
                          textEditingController: _positionController,
                          validator: validateRequired,
                          onSaved: contactBloc.savePosition,
                        ),
                        CustomTextFormFieldWidget(
                          readOnly: !widget.isValid,
                          labelText: "Company's Address",
                          focusNode: _addressFocusNode,
                          nextFocusNode: _phoneFocusNode,
                          maxLines: null,
                          textInputAction: TextInputAction.newline,
                          keyboardType: TextInputType.multiline,
                          textEditingController: _addressController,
                          validator: validateRequired,
                          onSaved: contactBloc.saveAddress,
                        ),
                      ],
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.symmetric(vertical: 10),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(10),
                      color: Colors.white,
                    ),
                    padding: EdgeInsets.all(10),
                    child: CustomTextFormFieldWidget(
                      readOnly: !widget.isValid,
                      labelText: "Phone Number",
                      focusNode: _phoneFocusNode,
                      nextFocusNode: _emailFocusNode,
                      textEditingController: _phoneController,
                      validator: validateRequiredNumber,
                      keyboardType: TextInputType.number,
                      onSaved: contactBloc.savePhone,
                    ),
                  ),
                  Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(10),
                      color: Colors.white,
                    ),
                    padding: EdgeInsets.all(10),
                    child: CustomTextFormFieldWidget(
                      readOnly: !widget.isValid,
                      labelText: "Email",
                      focusNode: _emailFocusNode,
                      nextFocusNode: new FocusNode(),
                      textInputAction: TextInputAction.done,
                      textEditingController: _emailController,
                      validator: validateEmail,
                      onSaved: contactBloc.saveEmail,
                    ),
                  ),
                ],
              ),
            ),
          ),
        ),
        StreamBuilder(
          initialData: false,
          stream: GlobalBloc.loadingStream,
          builder: (BuildContext ctxLoading, AsyncSnapshot<bool> snapshot){
            return LoadingWidget(snapshot.data);
          },
        )
      ],
    );
  }
}