<?php

use yii\db\Migration;

/**
 * Class m241220_095157_create_categories
 */
class m241220_095157_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create table
        $this->createTable('{{%category}}', [
            'id_category' => $this->primaryKey(),
            'id_type' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull(),
            'parent' => $this->integer()->defaultValue(null),
            'category_name' => $this->string(255)->defaultValue(null),
            'category_description' => $this->text()->notNull(),
            'category_image' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->notNull(),
        ]);

        // Insert data
        $this->batchInsert('{{%category}}', 
            ['id_category', 'id_type', 'id_user', 'parent', 'category_name', 'category_description', 'category_image', 'status'], 
            [
                [1, 2, 1, null, 'Groceries', '', 'geM7260aDJwZDFSg.jpg', 1],
                [2, 2, 1, null, 'Vegitables', '', 'wplus_gbi_89EajKAmqVVb.jpg', 1],
                [3, 2, 1, null, 'Education', '', 'wplus_7uBU9JNVg8jE4zbc.jpg', 1],
                [4, 2, 1, null, 'Dairy Products', '', 'wplus_nwRYO8rHxSk2SD6r.jpg', 1],
                [5, 2, 1, null, 'Medical', '', 'wplus_C02LxR218fOnm7Sf.jpg', 1],
                [6, 2, 1, null, 'Food', '', 'wplus_2WUgJRkpc29lMxVm.jpeg', 1],
                [7, 2, 1, null, 'Miscellaneous Expenses', '', 'wplus_DIaMhgkjWnvWzvht.jpeg', 1],
                [8, 2, 1, null, 'Snacks', '', 'wplus_F12yW5I0HbXwkrEB.png', 1],
                [9, 2, 1, null, 'Meat', '', 'wplus_I7U62QcJHtjmMqKO.jpg', 1],
                [10, 2, 1, null, 'Internet', '', 'G3EiIx70e1B7D4oD.jpg', 1],
                [11, 2, 1, null, 'Clothing', '', 'wplus_ZxciRlQesABQQMcR.jpeg', 1],
                [12, 2, 1, null, 'Home', '', 'wplus_mINVwOvWtMGfmowD.jpeg', 1],
                [13, 2, 1, null, 'Transportation', '', 'wplus_csDHbha_FYWlsF2G.jpeg', 1],
                [14, 2, 1, null, 'Money Transfer', '', 'wplus_IelL7soZripGZvNv.jpeg', 1],
                [15, 2, 1, null, 'Games', '', 'wplus_l0av9bpIzJ_xNEnh.png', 1],
                [16, 2, 1, null, 'Beauty Products', '', 'wplus_1zmK_0OTQVdrMh2z.jpg', 1],
                [17, 3, 1, null, 'Rent', '', 'wplus_JLpvVfU3uDAKCtK7.jpeg', 1],
                [19, 2, 1, 6, 'Fruits', '', '5ZmsKDdmU2HO7X-S.jpg', 1],
                [20, 2, 1, 1, 'Baby Products', '', 'sgCMrYb_e6Nx6mD3.jpeg', 1],
                [21, 1, 1, null, 'Savings', '', 'wplus_Sp_sit9oMx9aiZYU.jpg', 1],
                [22, 2, 1, 1, 'Entertainment', '', 'wplus_89oDEvmX_yPNovfb.jpg', 1],
                [23, 2, 1, null, 'EMI Payments', '', 'wplus_3lHmVx_S5_F4PeoC.jpg', 1],
                [24, 2, 1, 1, 'Grooming', '', 'wplus_r8-IMreD58K4RgP5.jpg', 1],
                [25, 3, 1, null, 'Salary', '', 'wplus_fWaTNxytbETgQ9d9.jpeg', 1],
                [26, 2, 1, null, 'House Rent', '', 'wplus_1EqCdCXvk9U0f2lh.jpeg', 1],
                [27, 1, 1, null, 'Emergency Fund', '', 'wplus_kR0Nv51k_Xf311xd.jpg', 1],
                [28, 1, 1, null, 'Long Term Savings', '', 'wplus_3Upwg_LdmKLLmgJu.jpg', 1],
                [29, 1, 1, null, 'Short Term Savings', '', 'wplus_OBkUOaMzZ5PDj3RK.jpg', 1],
                [31, 2, 1, null, 'Travel', '', 'wplus_Fm9Zig9WG8GZDFXH.jpg', 1],
                [32, 2, 1, null, 'Donations', '', 'wplus_hpKFd3o6prwff5JM.jpeg', 1],
                [33, 1, 1, null, 'Gold (Grams)', '', 'wplus_pqyvqlsHacy3QSPO.jpg', 1],
                [34, 2, 1, null, 'Automobile', '', 'wplus_lrrGXhzQVUarjqsD.png', 1],
                [35, 2, 1, null, 'Zakat', '', 'wplus_ZDfODMFJy73CICUT.jpeg', 1],
                [36, 2, 1, null, 'Hadiya ', '', 'wplus_zI2_kShV25RptX29.jpeg', 1],
                [37, 2, 1, null, 'Fitra', '', 'wplus_i4OmGNrdPY4shBRt.jpg', 1],
                [38, 2, 1, null, 'Sadqa', '', 'wplus_ycUmNTvaXrw3TmIJ.jpg', 1],
                [39, 3, 1, null, 'Chit', '', 'wplus_44IyUFrijrsnBjcI.jpg', 1],
                [40, 3, 1, null, 'Tax Refund', '', 'wplus_DJJqM6rOMJdjkBGK.jpeg', 1],
                [41, 2, 1, null, 'Drinking Water Bottles', '', 'wplus_4tkOXPfr9Z5k1bY8.jpg', 1],
                [42, 2, 1, null, 'Electricity ', '', 'wplus_OOiflZmIjD-ohWJK.jpg', 1],
                [43, 3, 1, null, 'Stock dividend', '', 'wplus_NT0BiJUwxph-KPYT.jpg', 1],
                [44, 3, 1, null, 'Cashback', '', 'wplus_NNKSG-4_VzDJAXIk.jpg', 1],
                [45, 1, 1, null, 'Car Savings ', '', 'wplus_PGQ30j1IIebkiFX4.jpg', 1],
                [46, 3, 1, null, 'Zaggle', '', 'wplus_PldAsL1KjtRUYpVC.png', 1],
                [47, 2, 1, null, 'Furniture', '', 'wplus_Mn61sFaKK7SSHaKL.jpg', 1],
                [48, 5, 1, null, 'Gold', '', '', 1],
                [49, 5, 1, null, 'Silver', '', 'wplus_mO0Kdri9JnJh0ECF.jpg', 1],
                [50, 5, 1, NULL, 'Trade Articles', '', '', 1],
                [51, 5, 1, NULL, 'Livestock', '', '', 0],
                [52, 5, 1, NULL, 'Minerals', '', '', 1],
                [53, 5, 1, NULL, 'Agricultural Produce', '', 'wplus_h3QMKlYZVX9fs-4h.jpg', 1],
                [54, 5, 1, NULL, 'Treasures', '', '', 1],
                [55, 5, 1, NULL, 'Currencies', '', 'wplus_nxfH6MNaSyLAeK_L.jpg', 1],
                [56, 5, 1, 51, 'Camel', '', 'wplus_W2MuOSyiQQoMb6B9.png', 1],
                [57, 5, 1, 51, 'Cows', '', 'wplus__drR9E3dg18KSgR0.jpg', 1],
                [58, 5, 1, 51, 'Goats', '', 'wplus_BcnDhShE7qHigR33.jpg', 1],
                [59, 5, 1, 53, 'Irrigated', '', '', 1],
                [60, 5, 1, 53, 'Non Irrigated', '', '', 1],
                [61, 2, 1, NULL, 'Protection', '', '', 0],
                [62, 2, 1, NULL, 'Appliances', '', 'wplus_VCE1PtSVRXbLb9KP.jpg', 1],
                [63, 1, 1, NULL, 'Mutual Funds', '', 'wplus_yAYUIzGFr7GkzmGS.jpg', 1],
                [64, 3, 1, NULL, 'Aug Jamat Fund', '', 'wplus_cDwi2B-fmQZzeiEk.png', 1],
                [65, 2, 1, NULL, 'Stationary', '', 'wplus_1726771135_eco-stationary-set-with-memo-pads-b56-onestop-original-imagyngyjgzsxvfh.jpeg', 1]
            ]);
    }

    public function safeDown()
    {
        // Drop table
        $this->dropTable('{{%category}}');
    }
}