import static org.junit.Assert.assertEquals;
import org.junit.Test;

class Params1 {
  String[] map;
  int result;
  Params1(String[] map, int result){
      this.map=map;
      this.result=result;
  }
}

public class RevolvingDoorsTest {

  @Test
  public void one() {
      Params1[] list = new Params1[] {
        new Params1(
              new String[]{ "    ### ",
                    "    #E# ",
                    "   ## # ",
                    "####  ##",
                    "# S -O-#",
                    "# ###  #",
                    "#      #",
                    "########"},
              2
          )
      };

    RevolvingDoors doors = new RevolvingDoors();

    for (int i = 0; i < list.length; i++) {
      int actual = doors.turns(list[0].map);
      assertEquals(list[0].result, actual);
    }
  }
}
