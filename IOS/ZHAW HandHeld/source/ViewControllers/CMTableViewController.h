//
//  CMTableViewController.h
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/17/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "HHArticleModel.h"
#import "SqLiteDatabaseManager.h"
#import "CMMainMenuItem.h"

@class CMMainMenuItem;
@interface CMTableViewController : UINavigationController <UITableViewDelegate, UITableViewDataSource>
{

    HHArticleModel* article;
    SqLiteDatabaseManager* dbManager;
    NSMutableArray* tableFieldItems;
    IBOutlet UITableView* tableView;

}
@property (nonatomic, retain) HHArticleModel *article;
@property (nonatomic, retain) SqLiteDatabaseManager *dbManager;
@property (nonatomic, retain) NSMutableArray *tableFieldItems;
@property (nonatomic, retain) IBOutlet UITableView* tableView;

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db;

@end
