import static org.junit.Assert.assertEquals;
import org.junit.Test;

class Params {
  String start;
  String finish;
  String[] forbid;
  int result;
  Params(String start, String finish, String[] forbid, int result){
      this.start=start;
      this.finish=finish;
      this.forbid=forbid;
      this.result=result;
  }
}

public class SmartWordToyTest {

  @Test
  public void one() {
      Params[] list = new Params[] {
        new Params(
              "aaaa",
              "zzzz",
              new String[]{"a a a z", "a a z a", "a z a a", "z a a a", "a z z z", "z a z z", "z z a z", "z z z a"},
              8
          ),
          new Params(
              "aaaa",
              "bbbb",
              new String[]{},
              4
          ),
          new Params(
              "aaaa",
              "mmnn",
              new String[]{},
              50
          ),
          new Params(
              "aaaa",
              "zzzz",
              new String[]{"bz a a a", "a bz a a", "a a bz a", "a a a bz"},
              -1
          ),
          new Params(
              "aaaa",
              "zzzz",
              new String[]{
                  "cdefghijklmnopqrstuvwxyz a a a",
                  "a cdefghijklmnopqrstuvwxyz a a",
                  "a a cdefghijklmnopqrstuvwxyz a",
                  "a a a cdefghijklmnopqrstuvwxyz"
              },
              6
          ),
          new Params(
              "aaaa",
              "bbbb",
              new String[]{"b b b b"},
              -1
          ),
          new Params(
              "zzzz",
              "aaaa",
              new String[]{
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk",
                  "abcdefghijkl abcdefghijkl abcdefghijkl abcdefghijk"
              },
              -1
          )
      };

    SmartWordToy toy = new SmartWordToy();

    for (int i = 0; i < list.length; i++) {
      int actual = toy.minPresses(list[0].start, list[0].finish, list[0].forbid);
      assertEquals(list[0].result, actual);
    }
  }
}
