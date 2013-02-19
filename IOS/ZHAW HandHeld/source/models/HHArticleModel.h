//
//  HHArticleModel.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "HHTemplateModel.h"
#import "SqLiteDatabaseManager.h"
#import <UIKit/UIKit.h>

@class SqLiteDatabaseManager;
@class HHTemplateModel;
@interface HHArticleModel : NSObject
{
    NSString* name;
    NSNumber* template_id;
    NSDictionary* data;
    
    HHTemplateModel* template;
    SqLiteDatabaseManager* _dbManager;
    
}

@property (nonatomic, retain) NSString* name;
@property (nonatomic, retain) NSNumber* template_id;
@property (nonatomic, retain) NSDictionary* data;

@property (nonatomic, retain) HHTemplateModel* template;

- (id)initWithDBManager:(SqLiteDatabaseManager *)dbManager andDocumentArray:(NSArray *)articleArray;
- (UIViewController *)getViewControllerForTemplate;

@end
