package user;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

import util.DatabaseUtill;

public class UserDAO {

	//sign in
	public int login(String userID, String userPassword) {
		
		String SQL ="SELECT userPassword FROM USER WHERE userID =?";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		try {
			conn = DatabaseUtill.getConnection();
			pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, userID);
			rs=pstmt.executeQuery();
			if(rs.next()) {
				if(rs.getString(1).equals(userPassword)) {
					return 1; //sign in succeed
				}
				else {
					return 0; //password wrong
				}
			}
			return -1; //No ID
		}
		catch(Exception e) {
			e.printStackTrace();
		}
		finally {
			try {
				if(conn != null) conn.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(pstmt != null) pstmt.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(rs != null) rs.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
		}
		return -2;
	}
	
	//sign up
	public int join(UserDTO user) {
		
		String SQL ="INSERT INTO USER VALUES(?,?,?,?,false)";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		try {
			conn = DatabaseUtill.getConnection();
			pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, user.getUserID());
			pstmt.setString(2, user.getUserPassword());
			pstmt.setString(3, user.getUserEmail());
			pstmt.setString(4, user.getUserEmailHash());
			return pstmt.executeUpdate();
		}
		catch(Exception e) {
			e.printStackTrace();
		} 
		finally {
			try {
				if(conn != null) conn.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(pstmt != null) pstmt.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(rs != null) rs.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
		}
		return -1; //fail
	}	

//EmailChecked
	public boolean getUserEmailChecked(String userID) {
		
		String SQL ="SELECT userEmailChecked FROM USER WHERE userID = ?";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		
		try {
			conn = DatabaseUtill.getConnection();
			pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, userID);
			rs = pstmt.executeQuery();
			if(rs.next()) {
				return rs.getBoolean(1);
			}
		}
		catch(Exception e) {
			e.printStackTrace();
		} 
		finally {
			try {
				if(conn != null) conn.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(pstmt != null) pstmt.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(rs != null) rs.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
		}
		return false; //database error
	}	
	//getUserEmail
	
	public String getUserEmail(String userID) {
		String SQL ="SELECT userEmail FROM USER WHERE userID = ?";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		try {
			conn = DatabaseUtill.getConnection();
			pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, userID);
			rs=pstmt.executeQuery();
			if(rs.next()) {
				return rs.getString(1);
			}
			
		}
		catch(Exception e) {
			e.printStackTrace();
		} 
		finally {
			try {
				if(conn != null) conn.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(pstmt != null) pstmt.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(rs != null) rs.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
		}
		return null; //fail
	}
	
	
//setUserEmailChecked
	public boolean setUserEmailChecked(String userID) {
		
		String SQL ="UPDATE USER SET userEmailChecked = true WHERE userID =?";
		Connection conn = null;
		PreparedStatement pstmt = null;
		ResultSet rs = null;
		try {
			conn = DatabaseUtill.getConnection();
			pstmt = conn.prepareStatement(SQL);
			pstmt.setString(1, userID);
			pstmt.executeUpdate();
			return true;
		}
		catch(Exception e) {
			e.printStackTrace();
		} 
		finally {
			try {
				if(conn != null) conn.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(pstmt != null) pstmt.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
			try {
				if(rs != null) rs.close();
			}
			catch(Exception e) {
				e.printStackTrace();
			}
			
		}
		return false; //fail
	}	
}