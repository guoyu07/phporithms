// Simplest possible test with CppUnit
#include <cppunit/extensions/HelperMacros.h>
class SimplestCase : public CPPUNIT_NS::TestFixture
{
    CPPUNIT_TEST_SUITE( SimplestCase );
    CPPUNIT_TEST( MyTest );
    CPPUNIT_TEST_SUITE_END();
protected:
    void MyTest();
};

CPPUNIT_TEST_SUITE_REGISTRATION( SimplestCase );

void SimplestCase::MyTest()
{
    float fnum = 2.00001f;
    CPPUNIT_ASSERT_DOUBLES_EQUAL( fnum, 2.0f, 0.0005 );
}
