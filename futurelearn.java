package moocs;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;
import org.jsoup.nodes.Element;
import org.jsoup.*;
import org.jsoup.select.*;
import org.jsoup.select.Elements.*;


import java.sql.*;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.regex.*;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;


public class futurelearn {

	/**
	 * @param args
	 * @throws IOException 
	 * @throws ClassNotFoundException 
	 * @throws IllegalAccessException 
	 * @throws InstantiationException 
	 * @throws SQLException 
	 */
	public static void main(String[] args) throws IOException, InstantiationException, IllegalAccessException, ClassNotFoundException, SQLException 
	{
		PrintWriter file = new PrintWriter((new FileWriter("/Users/AlSyR/Downloads/MOOCSdata")));
		PrintWriter file2 = new PrintWriter((new FileWriter("/Users/AlSyR/Downloads/MOOCSdata2")));

		String url1 = "https://www.futurelearn.com/courses/categories/business-and-management";
		String url2 = "https://www.futurelearn.com/courses/categories/creative-arts-and-media";
		String url3 = "https://www.futurelearn.com/courses/categories/health-and-psychology";
		String url4 = "https://www.futurelearn.com/courses/categories/history";
		String url5 = "https://www.futurelearn.com/courses/categories/languages-and-cultures";
		String url6 = "https://www.futurelearn.com/courses/categories/law";
		String url7 = "https://www.futurelearn.com/courses/categories/literature";
		String url8 = "https://www.futurelearn.com/courses/categories/nature-and-environment";
		String url9 = "https://www.futurelearn.com/courses/categories/online-and-digital";
		String url10 = "https://www.futurelearn.com/courses/categories/politics-and-the-modern-world";
		String url11 = "https://www.futurelearn.com/courses/categories/science-maths-and-technology";
		String url12 = "https://www.futurelearn.com/courses/categories/sport-and-leisure";
		String url13 = "https://www.futurelearn.com/courses/categories/teaching-and-studying";

		int profNumber=1;
		int courseNumber=1;

		ArrayList<String> pgcrs = new ArrayList<String>(); //Array which will store each course URLs 
		pgcrs.add(url1);
		pgcrs.add(url2);
		pgcrs.add(url3);
		pgcrs.add(url4);
		pgcrs.add(url5);
		pgcrs.add(url6);
		pgcrs.add(url7);
		pgcrs.add(url8);
		pgcrs.add(url9);
		pgcrs.add(url10);
		pgcrs.add(url11);
		pgcrs.add(url12);
		pgcrs.add(url13);

		//System.setProperty("javax.net.ssl.trustStore", "/Users/AlSyR/Downloads/gdig2.jks");

		//The following few lines of code are used to connect to a database so the scraped course content can be stored.
		//Class.forName("com.mysql.jdbc.Driver").newInstance();
		//java.sql.Connection connection = DriverManager.getConnection("jdbc:mysql://localhost/scrapedcourse","root","");
		//make sure you create a database named scrapedcourse in your local mysql database before running this code
		//default mysql database in your local machine is ID:root with no password
		//you can download scrapecourse database template from your Canvas account->modules->Team Project area

		for(int a=0; a<pgcrs.size();a++)
		{
			String furl = (String) pgcrs.get(a);
			Document doc = Jsoup.connect(furl).get();
			String theCategory = doc.title();
			Elements ele = doc.select("div[class*=m-course-run__main]");
			Elements crspg = ele.select("a[title]");
			Elements link = crspg.select("a[href]");

			Elements ele2 = doc.select("footer[class*=clearfix]");
			Elements theStartDate1 = ele2.select("span[class=run-data]");
			Elements theStartDate = theStartDate1.select("time[datetime]");

			Elements theUniversity1 = ele.select("h3[class=organisation headline headline-secondary]");
			Elements theUniversity = theUniversity1.select("meta[content]");

			Elements thePicture1 = doc.select("a[class=m-course-run__media media-zoom]");
			Elements thePicture = thePicture1.select("img[srcset]");


			int g =0;
			for(int f=0; f<link.size(); f++)
			{
				String course_link = "https://www.futurelearn.com" +link.get(f).attr("href"); //Get the Course Url from href tag and add to www.edx.org to get the full URL to the course
				Document crsdoc = Jsoup.connect(course_link).get();

				Elements crsTitleEle = crsdoc.select("div[class=o-page-header__title-with-logo]");
				String title = crsTitleEle.text();

				Elements crsSDescEle1 = crsdoc.select("div[class=a-content a-content--contiguous-top a-content--tight-bottom u-centered u-relative]");
				Elements crsSDescEle = crsSDescEle1.select("p[class=text-typescale]");
				String short_desc = crsSDescEle.text();

				Elements crsLDescEle1 = crsdoc.select("div[class=run-description]");
				Element crsLDescEle = crsLDescEle1.select("p").first();
				String long_desc = crsLDescEle.text();

				//http://view.vzaar.com/4735645
				Elements crsVideoEle1 = crsdoc.select("video.video-js.vjs-futurelearn-skin");
				String crsVideoEle = crsVideoEle1.attr("data-sd-src");
				String video_link = "";
				if(crsVideoEle != "")
					video_link = "http:" + crsVideoEle.replace("/video", ".mp4");


				String start_date ="";
//				if(g<theStartDate.size())
//					start_date = theStartDate.get(g).attr("datetime");
//				else
//					start_date = "0000-00-00";

				Elements rundata = crsdoc.select("div[class=run-metadata run-metadata-block]");
				String someRunData = rundata.select("p[class=run-data").text();

				//FREE online course Duration: 4 weeks 2 hours pw Certificates available
//				Pattern courseLengthPattern = Pattern.compile("Duration: (.*?weeks)\\ ");
//				Matcher courseLengthMatcher = courseLengthPattern.matcher(someRunData);
//				courseLengthMatcher.find();
//				String course_length = courseLengthMatcher.group(1);
				Pattern courseLengthPattern = Pattern.compile("Duration: (.*?)\\ weeks");
				Matcher courseLengthMatcher = courseLengthPattern.matcher(someRunData);
				courseLengthMatcher.find();
				String course_length1 = courseLengthMatcher.group(1);
				int course_length = Integer.parseInt(course_length1);

				String temp_image = thePicture.get(g).attr("srcset");
				String course_image = temp_image.substring(temp_image.indexOf("http"),temp_image.indexOf(" "));

				//Free Online Media & Art Courses - FutureLearn
				Pattern courseCategoryPattern = Pattern.compile("Online (.*?) Courses - FutureLearn");
				Pattern courseCategoryPattern2 = Pattern.compile("(.*?) Courses - FutureLearn");
				Matcher courseCategoryMatcher = courseCategoryPattern.matcher(theCategory);
				Matcher courseCategoryMatcher2 = courseCategoryPattern2.matcher(theCategory);
				String category="";
				if(courseCategoryMatcher.find())
					category = courseCategoryMatcher.group(1);
				else if(courseCategoryMatcher.find())
					category = courseCategoryMatcher2.group(1);

				String site = "FutureLearn.com";
				int course_fee = 0;
				String language = "english";

				//FREE online course Duration: 4 weeks 2 hours pw Certificates available
				Pattern courseCertificatePattern = Pattern.compile("Certificates (.*$)");
				Matcher courseCertificateMatcher = courseCertificatePattern.matcher(someRunData);
				String certificate = "";
				if(courseCertificateMatcher.find())
					certificate = "yes";
				else
					certificate = "no";

				String university = theUniversity.get(g).attr("content");

				Pattern courseDedicationPattern = Pattern.compile("weeks (.*?hours pw)\\ ?");
				Matcher courseDedicationMatcher = courseDedicationPattern.matcher(someRunData);
				String time_Dedication = "";
				if(courseDedicationMatcher.find())
					time_Dedication = courseDedicationMatcher.group(1);
				else
					time_Dedication = "1 hour pw";

				DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
				Calendar cal = Calendar.getInstance();
				//Date date = new Date();
				//dateFormat.format(date) //2014/08/06 15:59:48
				String time_scraped = dateFormat.format(cal.getTime());

				Elements profdata1 = crsdoc.select("div[class=educator]");
				Elements profdata = profdata1.select("div[class=names]");
				ArrayList<String> profname = new ArrayList<String>();
				for(int i=0; i<profdata.size(); i++){
					String temp = profdata.get(i).text();
					if(temp.contains("("))
						profname.add(temp.replace(temp.substring(temp.indexOf(" ("), temp.indexOf(")")+1), ""));
					else if(temp.contains("["))
						profname.add(temp.replace(temp.substring(temp.indexOf(" ["), temp.indexOf("]")+1), ""));
					else if(temp.contains("Educator"))
						profname.add(temp.replace(" - Lead Educator", ""));
					else
						profname.add(temp);
				}

				Elements profdata2 = profdata1.select("a[class=avatar-link clearfix");
				Elements profdata3 = profdata2.select("img[src]");
				ArrayList<String> profimage = new ArrayList<String>();
				for(int i=0; i<profdata.size(); i++){
					profimage.add(profdata3.get(i).attr("src"));
				}

//				System.out.println("-----------------" + title);
//				System.out.println(short_desc);
//				System.out.println("->"+long_desc);
//				System.out.println("->"+course_link);
				System.out.println("->"+video_link);
//				System.out.println("->Start Date "+start_date);
//				System.out.println("->Course Length "+course_length);
//				System.out.println("->"+course_image);
//				System.out.println("->Course Category "+category);
//				System.out.println("->"+site);
//				System.out.println("->Fees "+course_fee);
//				System.out.println("->Language "+language);
//				System.out.println("->Certificates "+certificate);
//				System.out.println("->University "+university);
//				System.out.println("->Time Scraped "+time_scraped);
//
//				for(int j=0; j<profname.size(); j++){
//					System.out.println("->profName "+ profdata.size() + " " +profname.get(j));
//					System.out.println("->profimage "+ profdata3.size() + " " +profimage.get(j));
//				}
				
				String value;
				value = "(" +(courseNumber)+ ", '" +title+ "', '" +short_desc+ "', '" +long_desc+ "', '" +course_link+ "', '" +video_link+ "', '" +start_date+ "', " +course_length+ ", '" +course_image+ "', '" +category+ "', '" +site+ "', " +course_fee+ ", '" +language+ "', '" +certificate+ "', '" +university+ "', '" +time_scraped+ "'),";
				file.println(value);
				

				for(int j=0; j<profname.size(); j++){
					String value2;
					value2 = "(" +(profNumber++)+ ", '" +profname.get(j)+ "', '" +profimage.get(j)+ "', " +(courseNumber)+ "),";
					file2.println(value2);
				}
				courseNumber++;
				f++;
				g++;
			}

		}
		file.close();
		file2.close();
	}

}