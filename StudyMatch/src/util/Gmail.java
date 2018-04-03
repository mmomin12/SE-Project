package util;

import javax.mail.Authenticator;
import javax.mail.PasswordAuthentication;

public class Gmail extends Authenticator {
	
	@Override
	protected PasswordAuthentication getPasswordAuthentication() {
		//panthercoders20180@gmail will send the verificaton mail.
		return new PasswordAuthentication("gsumatching@gmail.com", "mussa2018");
		
	}
	

}
